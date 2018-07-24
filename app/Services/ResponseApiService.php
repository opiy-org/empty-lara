<?php

namespace App\Services;

use App\Helpers\l;
use Carbon\Carbon;
use Illuminate\Validation\Validator;

/**
 * @resource Response
 *
 * Class ResponseApiService
 *
 * @package App\Services
 */
class ResponseApiService
{
    /**
     * Success
     *
     * @param $data
     * @param string|null $msg
     * @param array $extra_out
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success($data = null, $msg = null, array $extra_out = [])
    {
        $out = [
            'result' => true,
            'data' => $data,
            'timestamp' => Carbon::now()
        ];

        if (count($extra_out) > 0) {
            $out = array_merge($out, $extra_out);
        }

        if ($msg !== null) {
            $out = array_merge($out, ['msg' => $msg]);
        }

        return response()->json($out);
    }


    /**
     * Validation Error
     *
     * @param $data array
     * @param Validator $validator
     * @param string|null $msg
     * @param array $extra_out
     * @return \Illuminate\Http\JsonResponse
     */
    public static function validateError($data, Validator $validator, $msg = null, array $extra_out = [])
    {

        $out = [
            'result' => false,
            'data' => $data,
            'errors' => $validator->errors()->toArray(),
            'timestamp' => Carbon::now()
        ];

        if (count($extra_out) > 0) {
            $out = array_merge($out, $extra_out);
        }

        if ($msg !== null) {
            $out = array_merge($out, ['msg' => $msg]);
        }

        l::debug('ResponseApi Error: ', print_r($out, true));

        return response()->json($out, 422);
    }


    /**
     * Not found
     *
     * @param $data
     * @param string|null $msg
     * @param array $extra_out
     * @return \Illuminate\Http\JsonResponse
     */
    public static function notFound($data = null, $msg = null, array $extra_out = [])
    {
        $out = [
            'result' => false,
            'data' => $data,
            'timestamp' => Carbon::now()
        ];

        if (count($extra_out) > 0) {
            $out = array_merge($out, $extra_out);
        }

        if ($msg !== null) {
            $out = array_merge($out, ['msg' => $msg]);
        }

        //   l::debug('ResponseApi Error: ' , print_r($out, true));

        return response()->json($out, 404);
    }


    /**
     * Bad Request
     *
     * @param $data
     * @param string|null $msg
     * @param array $extra_out
     * @return \Illuminate\Http\JsonResponse
     */
    public static function badRequest($data = null, $msg = null, array $extra_out = [])
    {
        $out = [
            'result' => false,
            'data' => $data,
            'timestamp' => Carbon::now()
        ];

        if (count($extra_out) > 0) {
            $out = array_merge($out, $extra_out);
        }

        if ($msg !== null) {
            $out = array_merge($out, ['msg' => $msg]);
        }

        l::debug('ResponseApi Error: ', print_r($out, true));

        return response()->json($out, 400);
    }


    /**
     * Server error
     *
     * @param $data
     * @param \Exception|null $exception
     * @return \Illuminate\Http\JsonResponse
     */
    public static function serverError($data = null, \Exception $exception = null)
    {
        $out = [
            'result' => false,
            'data' => $data,
            'timestamp' => Carbon::now()
        ];


        if ($exception !== null && (config('app.env') !== 'production')) {
            $out = array_merge($out, [
                'exception' => [
                    'msg' => $exception->getMessage(),
                    'file' => $exception->getFile(),
                    'code' => $exception->getCode(),
                    'line' => $exception->getLine(),
                ]
            ]);
        }

        l::debug('ResponseApi Error: ', print_r($out, true));

        return response()->json($out, 500);
    }

    /**
     * Access denied
     *
     * @param $data
     * @param string|null $msg
     * @param array $extra_out
     * @return \Illuminate\Http\JsonResponse
     */
    public static function accessForbidden($data = null, $msg = null, array $extra_out = [])
    {
        $out = [
            'result' => false,
            'data' => $data,
            'timestamp' => Carbon::now()
        ];

        if (count($extra_out) > 0) {
            $out = array_merge($out, $extra_out);
        }

        if ($msg !== null) {
            $out = array_merge($out, ['msg' => $msg]);
        }

        //    l::debug('ResponseApi Error: ' , print_r($out, true));

        return response()->json($out, 403);
    }


    /**
     * Auth required
     *
     * @param $data
     * @param string|null $msg
     * @param array $extra_out
     * @return \Illuminate\Http\JsonResponse
     */
    public static function unauthorizedRequest($data = null, $msg = null, array $extra_out = [])
    {
        $out = [
            'result' => false,
            'data' => $data,
            'timestamp' => Carbon::now()
        ];

        if (count($extra_out) > 0) {
            $out = array_merge($out, $extra_out);
        }

        if ($msg !== null) {
            $out = array_merge($out, ['errors' => [$msg]]);
        }

        ///l::debug('ResponseApi Error: ' , print_r($out, true));

        return response()->json($out, 401);
    }
}
