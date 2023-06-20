<?php

namespace App\Models;

use Illuminate\Support\Facades\Http;

class SMS
{
    private $apiToken;

    function __construct($apiToken)
    {
        $this->apiToken = $apiToken;
    }

    function send($from, $to, $text)
    {
        $body = [
            "from" => $from,
            "to" => $to,
            "contents" => [
                [
                    "type" => "text",
                    "text" => $text
                ]
            ]
        ];

        $response = Http::withHeaders([
            'X-API-TOKEN' => $this->apiToken
        ])->post(
            'https://api.zenvia.com/v2/channels/sms/messages',
            $body
        );

        return $response;
    }
}
