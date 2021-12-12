<?php
namespace App\Http\Controllers;

trait ApiResponse {
    private function responseSuccess($data = null, $message = 'success')
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ]);
    }
    private function responseError($data = null, $message = 'error')
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => $data
        ]);
    }
}
