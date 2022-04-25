<?php

namespace App;

use Exception;

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

    /**
     * @param string $asset
     * @return string
     * @throws Exception
     */
    public static function asset(string $asset): string
    {
        $manifestPath = ROOT_PATH . '/public/mix-manifest.json';

        if (!is_file($manifestPath)) {
            throw new Exception('Manifest file not found', 500);
        }

        $manifest = file_get_contents($manifestPath);
        $manifest = json_decode($manifest, true);

        if (array_key_exists($asset, $manifest)) {
            return $manifest[$asset];
        }

        throw new Exception('Asset in manifest file not found', 500);
    }
}