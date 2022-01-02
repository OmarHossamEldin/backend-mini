<?php

namespace App\Helpers;

class JsonResponse
{
    /**
     * response formatting
     *
     * @param string $message
     * @param array $errors
     * @param array $data
     * @param integer $statusCode
     * @return object
     */
    public static function response(int $statusCode, string $message = '', array $errors = [], array $data = []): object
    {
        return response()->json([
            'message' => $message,
            'errors' => $errors,
            'data' => $data
        ], $statusCode);
    }
}
