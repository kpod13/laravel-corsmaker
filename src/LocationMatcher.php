<?php

namespace Kpod13\CorsMaker;

class LocationMatcher
{

    /**
     * Match location URI to array of patterns (strings of regexps)
     *
     * @param string $location
     * @param array $locationPatterns
     *
     * @return bool
     */
    public static function match(string $location, array $locationPatterns): bool
    {
        if ($location == '' || empty($locationPatterns)) {
            return false;
        }
        foreach ($locationPatterns as $pattern) {
            if ($pattern == '*') {
                return true;
            }
            if (RegexpChecker::check($pattern)) {
                if (preg_match($pattern, $location)) {
                    return true;
                } else {
                    return false;
                }
            }
            if (substr_count(strtolower($location), strtolower($pattern), 0) > 0) {
                return true;
            }
        }
        return false;
    }
}
