<?php

namespace App\Http\Controllers;

use App\Pigeon;
use Illuminate\Http\Request;
use App\Http\Resources\Pigeon as PigeonResource;
use Illuminate\Support\Facades\DB;
use Validator;

class PigeonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['result'] = PigeonResource::collection(Pigeon::all());
        $data['total'] = Pigeon::all()->count();
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
            'name' => 'required',
            'speed' => ['required','integer'],
            'range' => ['required','integer'],
            'cost' => ['required','integer'],
            'downtime' => ['required','integer'],
        ]);
        if ($validator->fails()) {
            // return our custom response
            return validatorResponse($validator);
        }

        DB::beginTransaction();
        try {
            // Insert Pigeon Data
            $pigeon = new Pigeon;
            $pigeon->name = $request->name;
            $pigeon->speed = $request->speed;
            $pigeon->range = $request->range;
            $pigeon->cost = $request->cost;
            $pigeon->downtime = $request->downtime;
            $pigeon->status = 0;
            $pigeon->save();
            DB::commit();
            return $this->show($pigeon->id);
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Pigeon::find($id)) {
            return customResponse("Pigeon Not Found", null, "404");
        }
        return new PigeonResource(Pigeon::find($id));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!Pigeon::find($id)) {
            return customResponse("Pigeon Not Found", null, 404);
        }

        $pigeon = Pigeon::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required_without_all:speed,range,cost,downtime,status',
            'speed' => ['required_without_all:name,range,cost,downtime,status','integer'],
            'range' => ['required_without_all:name,speed,cost,downtime,status','integer'],
            'cost' => ['required_without_all:name,speed,range,downtime,status','integer'],
            'downtime' => ['required_without_all:name,speed,range,cost,status','integer'],
            'status' => ['required_without_all:name,speed,range,cost,downtime','integer'],
        ]);
        if ($validator->fails()) {
            return staticErrorResponse("atleastonefield");
        }
        

        $pigeon->name = isset($request->name) ? $request->name : $pigeon->name;
        $pigeon->speed = isset($request->speed) ? $request->speed : $pigeon->speed;
        $pigeon->range = isset($request->range) ? $request->range : $pigeon->range;
        $pigeon->cost = isset($request->cost) ? $request->cost : $pigeon->cost;
        $pigeon->downtime = isset($request->downtime) ? $request->downtime : $pigeon->downtime;
        $pigeon->status = isset($request->status) ? $request->status : $pigeon->status;

        $pigeon->save();

        return $this->show($pigeon->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if (!Pigeon::find($id)) {
            return customResponse("Pigeon Not Found", null, 404);
        }

        $post = Pigeon::find($id);
        $post->delete();

        return response()->json(['message' => 'Pigeon Deleted Successfully']);
    }
}
