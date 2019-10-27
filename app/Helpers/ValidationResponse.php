<?php
/**
 * CUSTOM RESPONSES, IN CASE WE HAVE OUR OWN ERROR CODES, WANTS TO RETURN SOME DETAILS, ETC
 */

/**
 * For error responses from Laravel Validator 
 */
function validatorResponse($validator)
{
    return response()->json([
            'message'=> 'Input validation error',
            'detail'=>$validator->errors()
    ], 400);
}

/**
 * For custom error responses
 */
function customResponse($message,$detail,$htmlcode)
{
    if($detail){
        return response()->json([
            'message'=> $message,
                'detail'=>$detail
        ], $htmlcode);
    }
    else{
        return response()->json([
            'message'=> $message
        ], $htmlcode);
    }
}

/**
 * For static error responses
 * 
 * Available types 
 * 
 * atleastonefield : At Least One Field Must Be Filled
 * 
 */
function staticErrorResponse($type)
{
    if($type == "atleastonefield"){
        return response()->json([   
            'message'=> 'At Least One Field Must Be Filled',
        ], 400);
    }
    
}
