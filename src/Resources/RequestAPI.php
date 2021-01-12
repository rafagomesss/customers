<?php

declare(strict_types=1);

namespace Customer\Resources;

class RequestAPI
{
    public static function sendRequest(string $url, array $params = [])
    {
        $sendPost = (bool) count($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, $sendPost);
        if ($sendPost) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FAILONERROR, true);
        $resp = curl_exec($ch);

        if (curl_errno($ch)) {
            return ['error' => curl_errno($ch), 'message' => curl_error($ch)];
        }
        curl_close($ch);
        if ($resp) {
            return json_decode($resp, true);
        }

        return $resp;
    }
}
