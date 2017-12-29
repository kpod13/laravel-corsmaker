<?php

namespace Kpod13\CorsMaker;

class MethodMatcher
{

    /**
     * Check matching method to array of allowed methods
     *
     * @param string $method for checking
     * @param array $allowedMethods
     *
     * @return bool
     *
     */
    public static function match($method, array $allowedMethods)
    {
        if (empty($allowedMethods) || empty($method)) {
            return false;
        }
        foreach ($allowedMethods as $allowedMethod) {
            if ($method == $allowedMethod || $allowedMethod == '*') {
                return true;
            }
        }
        return false;
    }
}
