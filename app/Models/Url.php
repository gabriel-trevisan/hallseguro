<?php

namespace App\Models;

class Url
{
    function getSubDomain($url)
    {
        $parsedUrl = parse_url($url);
        $host = explode('.', $parsedUrl['host']);

        $subdomain = $host[0];

        return $subdomain;
    }

    function getDomain($url)
    {
        $parsedUrl = parse_url($url);
        $host = $parsedUrl['host'];

        return $host;
    }
}