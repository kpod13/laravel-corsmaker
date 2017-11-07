<?php

namespace Kpod13\CorsMaker;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsMakerService {

    /**
     * CorsMaker options
     *
     * @var array
     */
    private $options;

    /**
     * CorsMakerService constructor.
     */
    public function __construct() {
        $options = config('corsmaker');
        $this->options = $this->normalizeOptions($options);
    }

    /**
     * This function check and returns normalized options
     *
     * @param array $options
     *
     * @return array
     */
    private function normalizeOptions(array $options) : array {
        $template = [
          'rule' => [
          'request_headers' => [
            'origin' => '', // String can be empty, '*', normal string or regexp
            'methods' => [], // Array should contain an element '*' or some http methods ['GET', 'POST']
            'locations' => [], // Array should contain locations as normal strings or regexps
          ],
          'cors_headers' => [
            'credentials' => FALSE, // bool
            'allowedHeaders' => [], // Array should contain allowed access methods
          ],
          'p3p_headers' => [] // Array should contain P3P header values
          ]
        ];

        // Check for empty rules
        if (empty($options['rules'])) {
            $options['rules'] = $template['rules'];
        }

        // Check each rule
        foreach ($options['rules'] as &$rule) {
            // Check request headers
            if (empty($rule['request_headers'])) $rule['request_headers'] = $template['rule']['request_headers'];

            // Check cors headers
            if (empty($rule['cors_headers'])) $rule['cors_headers'] = $template['rule']['cors_headers'];

            // Check p3p headers
            if (empty($rule['p3p_headers'])) $rule['p3p_headers'] = $template['rule']['p3p_headers'];
        }
        return $options;
    }

    /**
     * Check request is CORS request
     *
     * @param Request $request
     *
     * @return bool
     */
    public function isCorsRequest(Request $request): bool {
        if ($request->hasHeader('Origin')) return true;
        return FALSE;
    }

    /**
     * Add CORS headers to request
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @param \Symfony\Component\HttpFoundation\Response $response
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addCorsHeaders(Request $request, Response $response): Response {

        $rules = $this->options['rules'];

        foreach ($rules as $rule) {
            if (!OriginMatcher::match($request->headers->get('Origin'), $rule['request_headers']['origin'])) continue;
            if (!MethodMatcher::match($request->getMethod(), $rule['request_headers']['methods'])) continue;
            if (!LocationMatcher::match('/' . $request->getBasePath(), $rule['request_headers']['locations'])) continue;
            if (!empty($rule['p3p_headers'])) {
                return ($response)
                  ->header('Access-Control-Allow-Origin', $request->header('Origin'))
                  ->header('Access-Control-Allow-Methods', implode(', ', $rule['request_headers']['methods']) . ', OPTIONS')
                  ->header('Access-Control-Allow-Headers', implode(', ', $rule['cors_headers']['allowedHeaders']))
                  ->header('P3P', implode(' ', $rule['p3p_headers']));
            }
            return ($response)
              ->header('Access-Control-Allow-Origin', $request->header('Origin'))
              ->header('Access-Control-Allow-Methods', implode(', ', $rule['request_headers']['methods']) . ' ,OPTIONS')
              ->header('Access-Control-Allow-Headers', implode(', ', $rule['cors_headers']['allowedHeaders']));
        }

    }
}