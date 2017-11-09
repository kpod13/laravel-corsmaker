<?php

namespace Kpod13\CorsMaker;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsMakerService {

    /**
     * This function check and returns normalized options
     *
     * @param array $options
     *
     * @return array
     */
    private function normalizeOptions(array $options): array {
        $template = [
            'rule' => [
                'request_headers' => [
                    'origin' => '',
                    'methods' => [],
                    'locations' => [],
                ],
                'cors_headers' => [
                    'allow_credentials' => FALSE,
                    'allowed_headers' => [],
                    'allowed_methods' => [],
                    'max_age' => 0
                ],
            ],
        ];

        // Check for empty rules
        if (empty($options['rules'])) {
            $options['rules'] = $template['rules'];
        }

        // Check each rule
        foreach ($options['rules'] as &$rule) {
            // Check request headers
            if (empty($rule['request_headers'])) {
                $rule['request_headers'] = $template['rule']['request_headers'];
            }

            // Check cors headers
            if (empty($rule['cors_headers'])) {
                $rule['cors_headers'] = $template['rule']['cors_headers'];
            }
        }
        return $options;
    }

    /**
     * Check request is a general CORS request
     *
     * @param Request $request
     *
     * @return bool
     */
    public function isSimpleCorsRequest(Request $request): bool {
        $simpleMethods = ['GET', 'POST', 'HEAD'];
        if ($request->hasHeader('Origin') and in_array($request->getMethod(), $simpleMethods)) {
            return TRUE;
        }
        return FALSE;
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function isPrefliedCorsRequest(Request $request): bool {
        if ($request->hasHeader('Origin') and $request->getMethod() == 'OPTIONS') return TRUE;
        return FALSE;
    }

    /**
     * Add CORS headers to request simple crossdomain requests
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Symfony\Component\HttpFoundation\Response $response
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addSimpleCorsHeaders(Request $request, Response $response): Response {
        $options = $this->normalizeOptions(config('corsmaker'));
        $rules = $options['rules'];
        foreach ($rules as $rule) {
            // Filter request
            if (!OriginMatcher::match($request->headers->get('Origin'), $rule['request_headers']['origin'])) {
                continue;
            }
            if (!MethodMatcher::match($request->getMethod(), $rule['request_headers']['methods'])) {
                continue;
            }
            if (!LocationMatcher::match('/' . $request->getBasePath(), $rule['request_headers']['locations'])) {
                continue;
            }

            // Add headers to response
            $response = ($response)->header('Access-Control-Allow-Origin', $request->header('Origin'));
            if ($rule['cors_headers']['allow_credentials']) {
                $response = ($response)->header('Allow-Credentials', 'true');
            } else {
                $response = ($response)->header('Allow-Credentials', 'false');
            }
            if (!empty($rule['cors_headers']['max_age'])) {
                $response = ($response)->header('Access-Control-Max-Age', $rule['cors_headers']['max_age']);
            }
            break;
        }
        return $response;
    }

    /**
     * Add CORS headers to preflight crossdomain requests
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Symfony\Component\HttpFoundation\Response $response
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addPreflightCorsHeaders(Request $request, Response $response): Response {
        $options = $this->normalizeOptions(config('corsmaker'));
        $rules = $options['rules'];
        foreach ($rules as $rule) {
            // Filter requests
            if (!OriginMatcher::match($request->headers->get('Origin'), $rule['request_headers']['origin'])) {
                continue;
            }
            if (!LocationMatcher::match('/' . $request->getBasePath(), $rule['request_headers']['locations'])) {
                continue;
            }
            if ($request->headers->has('Access-Control-Request-Method')) {
                if (!MethodMatcher::match($request->headers->get('Access-Control-Request-Method'), $rule['request_headers']['methods'])) continue;
            }
            if ($request->headers->has('Access-Control-Request-Headers')) {
                $accessControlRequestHeaders = explode(',', $request->headers->get('Access-Control-Request-Headers'));
                if (!HeadersMatcher::match($accessControlRequestHeaders, $rule['request_headers']['headers'])) continue;
            }

            // Add headers to response
            if ($rule['cors_headers']['allow_credentials']) {
                $response = ($response)->header('Allow-Credentials', 'true');
            } else {
                $response = ($response)->header('Allow-Credentials', 'false');
            }
            if (!empty($rule['cors_headers']['allowed_methods'])) {
                $response = ($response)->header('Access-Control-Allow-Methods', implode(', ', $rule['cors_headers']['allowed_methods']));
            }
            if (!empty($rule['cors_headers']['allowed_headers'])) {
                $response = ($response)->header('Access-Control-Allow-Headers', implode(', ', $rule['cors_headers']['allowed_headers']));
            }
            if (!empty($rule['cors_headers']['max_age'])) {
                $response = ($response)->header('Access-Control-Max-Age', $rule['cors_headers']['max_age']);
            }
            break;
        }
        return $response;
    }
}