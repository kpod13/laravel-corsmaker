<?php

namespace Kpod13\CorsMaker;

class OriginMatcher
{

    /**
     * Check matching origin string to pattern (string or regexp)
     *
     * @param string $origin
     * @param string $originPattern
     *
     * @return bool
     */
    public static function match($origin, $originPattern)
    {
        if (empty($origin) || empty($originPattern)) {
            return false;
        }
        if ($originPattern == '*' || $origin == $originPattern) {
            return true;
        }
        if (RegexpChecker::check($originPattern)) {
            if (preg_match($originPattern, $origin)) {
                return true;
            } else {
                return false;
            }
        }
        return false;
    }
}
