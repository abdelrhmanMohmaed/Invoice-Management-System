<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Response::macro('customResponse', function ($status, $data, $message, $statusCode = 200, $totalCount = null, $nextPageUrl = null, $prevPageUrl = null, $type = null) {
            $response = [
                'status' => (int) $status,
                'message' => $message,
                'data' => $data,
            ];

            if ($totalCount !== null) {
                $response['count'] = $totalCount;
            }

            if ($nextPageUrl !== null) {
                $response['next_page_url'] = $nextPageUrl;
            }

            if ($prevPageUrl !== null) {
                $response['prev_page_url'] = $prevPageUrl;
            }

            if ($type !== null) {
                $response['type'] = $type;
            }

            return Response::json($response, $statusCode);
        });

        Response::macro('validationErrorResponse', function ($errors) {
            $response = [
                'status' => false,
                'message' => 'Validation error',
                'errors' => $errors,
            ];

            return Response::json($response, 401);
        });

        Response::macro('successResponse', function ($message) {
            $response = [
                'status' => true,
                'message' => $message,
            ];

            return Response::json($response, 200);
        });

        Response::macro('errorResponse', function ($message, $statusCode = 500) {
            $response = [
                'status' => false,
                'message' => $message,
            ];

            return Response::json($response, $statusCode);
        });

    }

    public function register()
    {
        //
    }
}
