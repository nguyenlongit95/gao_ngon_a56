<?php

namespace App\Support;

use Illuminate\Http\JsonResponse;

/**
 * Class ResponseHelper
 *
 * @package App\Support
 */
class ResponseHelper
{
    /**
     * return success json, add payload
     *
     * @param  int  $statusCode
     * @param  null  $data
     * @param $message
     * @return JsonResponse
     */
    public function success($data = null, $statusCode = 200, $message = 'success')
    {
        return response()->json([
            'message' => $message,
            'code' => $statusCode,
            'data' => $data,
        ], 200);
    }

    /**
     * unauthenticated error
     *
     * @return JsonResponse
     */
    public function unauthenticated()
    {
        return response()->json([
            'message' => 'unauthenticated',
            'code' => 401,
            'data' => null,
        ], 401);
    }

    /**
     * error
     *
     * @param  int  $statusCode
     * @param  null  $data
     * @param  string  $message
     * @return JsonResponse
     */
    public function error($data = null, $statusCode = 500, $message = 'error')
    {
        \Log::info(json_encode($data));
        return response()->json([
            'message' => $message,
            'code' => $statusCode,
            'data' => $data,
        ], 500);
    }

    /**
     * not found
     *
     * @return JsonResponse
     */
    public function notFound()
    {
        return response()->json([
            'message' => 'not found',
            'code' => 404,
            'data' => null,
        ], 404);
    }

    /**
     * Handle lang date ranges
     * @return array
     */
    public function configDateRange()
    {
        $now = \Carbon\Carbon::now();
        //Get data ranges date
        $ranges = [
            '今日' => [$now, $now],
            '昨日' => [$now->subDays(1), $now->subDays(1)],
            '今週' => [$now->startOfWeek(), $now],
            '先週' => [$now->subWeeks(1), $now],
            '今月' => [$now->startOfMonth(), $now],
            '先月' => [$now->subMonths(1), $now],
        ];
        //Get data days of week
        $daysOfWeek = trans('common.days_of_week');
        //Get data month
        $monthNames = [];
        for ($i = 1; $i <= 12; $i++) {
            array_push($monthNames, $i . trans('common.month'));
        }

        return compact('ranges', 'daysOfWeek', 'monthNames');
    }
}
