<?php

namespace Kpod13\CorsMaker;

class HeadersMatcher {

    /**
     * Check matching header to array of allowed methods
     *
     * @param array $requestedHeaders
     * @param array $allowedHeaders
     *
     * @return bool
     */
    public static function match(array $requestedHeaders, array $allowedHeaders): bool {
        if (empty($allowedHeaders) || empty($requestedHeaders)) return FALSE;
        $countHeaders = count($requestedHeaders);
        $countMatches = 0;
        foreach ($requestedHeaders as $requestedHeader) {
            if (in_array($requestedHeader, $allowedHeaders)) $countMatches++;
        }
        if ($countMatches === $countHeaders) return TRUE;
        return FALSE;
    }
}