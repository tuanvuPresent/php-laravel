<?php

namespace App\Http\Controllers;

trait ApiResponse
{
    private function responseSuccess($data = null, $message = 'success', $statusCode = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => true,
            'data' => $data,
            'errors' => null,
            'message' => $message,
        ], $statusCode);
    }

    private function responseError($errors = null, $message = null, $statusCode = 400): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => false,
            'data' => null,
            'errors' => $errors,
            'message' => $message,
        ], $statusCode);
    }
}
