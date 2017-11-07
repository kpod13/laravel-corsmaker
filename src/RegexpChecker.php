<?php

namespace Kpod13\CorsMaker;


class RegexpChecker {

    /**
     * Check input string is regexp
     *
     * @param string $string
     *
     * @return bool
     */
    public static function check(string $string): bool {
        $pattern = '/^\/.*\/.?$/i';
        if (preg_match($pattern, $string)) return TRUE;
        return FALSE;
    }
}