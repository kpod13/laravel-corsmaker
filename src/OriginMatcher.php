<?php

namespace Kpod13\CorsMaker;

class OriginMatcher {

    /**
     * Check matching origin string to pattern (string or regexp)
     *
     * @param string $origin
     * @param string $originPattern
     *
     * @return bool
     */
    public static function match(string $origin, string $originPattern): bool {
        if (empty($origin) || empty($originPattern)) return FALSE;
        if ($originPattern == '*') return TRUE;
        if ($origin == $originPattern) return TRUE;
        if (RegexpChecker::check($originPattern)) {
            if (preg_match($originPattern, $origin)) return TRUE;
        }
        return FALSE;
    }
}