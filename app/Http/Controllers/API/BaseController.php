<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Validator;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class BaseController extends Controller
{
    /**
     * Return a successful response.
     */
    protected function sendResponse($result, $message = 'Success', $code = 200): JsonResponse
    {
        return response()->json([
            'status' => true,
            'code' => $code,
            'message' => $message,
            'data' => $result,
        ], $code);
    }

    /**
     * Return an error response.
     */
    protected function sendError($error, $code = 400): JsonResponse
    {
        return response()->json([
            'status' => false,
            'code' => $code,
            'message' => $error,
        ], $code);
    }

    /**
     * Return a validation error response.
     */
    protected function sendValidationError(Validator $validator): JsonResponse
    {
        return response()->json([
            'status' => false,
            'code' => SymfonyResponse::HTTP_UNPROCESSABLE_ENTITY,
            'message' => 'Validation Error',
            'errors' => $validator->errors(),
        ], SymfonyResponse::HTTP_UNPROCESSABLE_ENTITY);
    }
}
