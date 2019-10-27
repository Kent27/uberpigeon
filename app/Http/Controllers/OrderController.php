<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Resources\Order as OrderResource;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Pigeon;
use App\User;
use Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['result'] = OrderResource::collection(Order::all());
        $data['total'] = Order::all()->count();
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // Validate Inputs
        $validator = Validator::make($request->all(), [
            'distance' => ['required','integer'],
            'deadline' => ['required','date_format:Y-m-d H:i:s','after:created_at'],
            'user_id' => ['required','integer'],
        ]);
        if ($validator->fails()) {
            // return our custom response
            return validatorResponse($validator);
        }

        if (!User::find($request->user_id)) {
            return customResponse("User Not Found", null, 404);
        }


        DB::beginTransaction();
        try {
            // Insert Order Data
            $order = new Order;
       
            /*
            TODO: 
                - More precision on the deadline, price, etc (right now we're just using integer)
            */

            // Count minimum speed in km/hr
            $deadline_in_hours = Carbon::parse($request->created_at)->diffInHours(Carbon::parse($request->deadline));
            $minimum_speed = ceil($request->distance/$deadline_in_hours);

            if($pigeon = Pigeon::where([['speed', '>=', $minimum_speed],['status',Pigeon::STATUS_AVAILABLE]])->first()){
                $order->pigeon_id = $pigeon->id;
                $order->status = Order::STATUS_ON_PROGRESS;
                $order->total_price = $pigeon->cost * $request->distance;

                // Set Pigeon status
                $pigeon->status = Pigeon::STATUS_DELIVERING;
                $pigeon->save();
            }
            else{
                $order->status = Order::STATUS_REJECTED;
                $order->total_price = 0;
            }
            
            $order->distance = $request->distance;
            $order->deadline = $request->deadline;
            $order->user_id = $request->user_id;
            $order->save();
            DB::commit();
            if($order->status == Order::STATUS_ON_PROGRESS){
                return customResponse("Order Received", $this->show($order->id), "200"); 
            }
            else{
                return customResponse("Order Rejected", $this->show($order->id), "200");
            }
            
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Order::find($id)) {
            return customResponse("Order Not Found", null, "404");
        }
        return new OrderResource(Order::find($id));
    }

    /**
     * Update the status of an order.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function received_by_user($id)
    {
        if (!Order::find($id)) {
            return customResponse("Order Not Found", null, 404);
        }

        $order = Order::find($id);
        
        if($order->status == 0){
            $order->status = Order::STATUS_RECEIVED;

            $order->save();

            // Change status of pigeon
            if ($pigeon = Pigeon::find($order->pigeon_id)) {
                $pigeon->status = Pigeon::STATUS_DOWNTIME;
                $pigeon->save(); 
            }

            return customResponse("Order is successfully received, Pigeon is now on downtime", $this->show($order->id), 404);
        }
        else if($order->status == Order::STATUS_RECEIVED){
            return customResponse("Order was already received", $this->show($order->id), 404);
        }
        else{
            return customResponse("Order status was rejected", $this->show($order->id), 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if (!Order::find($id)) {
            return customResponse("Order Not Found", null, 404);
        }

        $post = Order::find($id);
        $post->delete();

        return response()->json(['message' => 'Order Deleted Successfully']);
    }
}
