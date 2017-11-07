<?php

namespace Kpod13\CorsMaker;

class MethodMatcher {

    /**
     * Check matching method to array of array of allowed methods
     *
     * @param string $method for checking
     * @param array $allowedMethods
     *
     * @return bool
     *
     */
    public static function match(string $method, array $allowedMethods): bool {
        if (empty($allowedMethods) || empty($method)) return FALSE;
        foreach ($allowedMethods as $allowedMethod) {
            if ($method == $allowedMethod) return TRUE;
        }
    }
}