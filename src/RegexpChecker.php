<?php

namespace Kpod13\CorsMaker;

class RegexpChecker
{

    /**
     * Check input string is regexp
     *
     * @param string $string
     *
     * @return bool
     */
    public static function check($string)
    {
        $pattern = '/^\/.*\/.?$/i';
        if (preg_match($pattern, $string)) {
            return true;
        }
        return false;
    }
}
