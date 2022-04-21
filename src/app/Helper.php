<?php

namespace App;

class Helper
{
    /**
     * @param string|null $message
     * @param array $data
     * @return string
     */
    public static function response(string $message = null, array $data = []): string
    {
        $response = [
            'success' => true,
            'errors'  => [],
            'message' => $message,
            'data'    => $data,
        ];

        header('Content-Type: application/json; charset=utf-8');

        return json_encode($response);
    }

    /**
     * @param string $message
     * @param array $errors
     * @return string
     */
    public static function responseError(string $message, array $errors = []): string
    {
        $response = [
            'success' => false,
            'errors'  => $errors,
            'message' => $message,
            'data'    => [],
        ];

        header('Content-Type: application/json; charset=utf-8');

        return json_encode($response);
    }
}