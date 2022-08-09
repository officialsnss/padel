<?php

namespace App\Utils;

use Illuminate\Http\JsonResponse;

/**
 * Class ResponseUtil
 *
 * @package App\Utils
 */
class ResponseUtil
{
    /**
     * This method can be used to send error response
     *
     * @param string $code
     * @param int $status
     *
     * @return JsonResponse
     */
    public static function error($code = "", $status = 400): JsonResponse
    {
        return response()->json(['code' => $code], $status);
    }


    /**
     * This method can be used to send error response with message
     *
     * @param string $message
     * @param string $code
     * @param int $status
     *
     * @return JsonResponse
     */
    public static function errorWithMessage($code, $message, $success = false, $status = 400): JsonResponse
    {
        return response()->json(['code' => $code, 'message' => $message, 'data' => [], 'success' => $success], $status);
    }


    /**
     * This method can be used to send error response with message bag
     *
     * @param array $errors
     * @param string $code
     * @param int $status
     *
     * @return JsonResponse
     */
    public static function errorWithMessageBag($errors, $success = false, $status = 400): JsonResponse
    {
        return response()->json(['code' => 400, 'errors' => $errors, 'success' => $success], $status);
    }


    /**
     * This method can be used to send success response
     *
     * @param string $code
     * @param int $status
     *
     * @return JsonResponse
     */
    public static function success($code = "data_fetched", $status = 200): JsonResponse
    {
        return response()->json(['code' => $code], $status);
    }


    /**
     * This method can be used to send success response with message
     *
     * @param string $message
     * @param string $code
     * @param int $status
     *
     * @return JsonResponse
     */
    public static function successWithMessage($code, $message, $success = true, $status = 200): JsonResponse
    {
        return response()->json(['code' => $code, 'message' => $message, 'success' => $success], $status);
    }

    /**
     * This method can be used to send success response with data
     *
     * @param $data
     * @param string $code
     * @param int $status
     *
     * @return JsonResponse
     */
    public static function successWithData($data, $success = true, $status = 200)
    {
        return response()->json(['code' => 200, 'success' => $success, 'data' => $data], $status);
    }

    public static function successWithDataToken($data, $message, $access_token, $expires_at, $success = true, $status = 200)
    {
        return response()->json(['code' => 200, 'success' => $success, 'message' => $message, 'token' => $access_token, 'expires_at' => $expires_at, 'data' => $data], $status);
    }

    /**
     * This method can be used to send success response with data
     *
     * @param $data
     * @param string $code
     * @param int $status
     * @param string $responseMessage
     * 
     *
     * @return JsonResponse
     */
    public static function successWithMessageData($data, $responseMessage, $success = true, $status = 200)
    {
        return response()->json(['code' => 200, 'success' => $success, 'responseMessage' => $responseMessage, 'data' => $data], $status);
    }

    /**
     * This method can be used to send success response with paginationb data
     *
     * @param $data
     * @param string $code
     * @param int $status
     *
     * @return JsonResponse
     */
    public static function successWithPaginationData($data, $success = true, $status = 200)
    {
        $data['success'] = $success;

        return response()->json(array_reverse($data), $status);
    }
}
