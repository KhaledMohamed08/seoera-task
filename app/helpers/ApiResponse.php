<?php

namespace App\helpers;

class ApiResponse
{
    public static function success($data = null, $message = 'Success', $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    public static function error($message = 'Error', $statusCode = 400, $errors = null)
    {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }

    public static function validationError($errors, $message = 'Validation Error', $statusCode = 422)
    {
        return self::error($message, $statusCode, $errors);
    }

    public static function unauthorized($message = 'Unauthorized', $statusCode = 401)
    {
        return self::error($message, $statusCode);
    }

    public static function forbidden($message = 'Forbidden', $statusCode = 403)
    {
        return self::error($message, $statusCode);
    }

    public static function notFound($message = 'Not Found', $statusCode = 404)
    {
        return self::error($message, $statusCode);
    }
}