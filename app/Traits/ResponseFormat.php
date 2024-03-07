<?php 
  namespace App\Traits;

  
  trait ResponseFormat{

    function jsonResponse($status, $data = null, $statusCode = 200)
    {
        $response = [
            'status' => $status,
        ];
        if ($status === 'success') {
            $response['data'] = $data;
        } elseif ($status === 'error') {
            $response['message'] = $data;
        }
        return response()->json($response, $statusCode);
        // return response()->json($response, $statusCode);
    }
  }