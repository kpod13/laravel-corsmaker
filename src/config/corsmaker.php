<?php

return [
    'rules' => [
        [
            /**
             * These options will be used for request filtering
             * @see for additional information here: https://learn.javascript.ru/xhr-crossdomain
             */
            'request_headers' => [
                /**
                 * Header 'Host'
                 * @example ''
                 * @example '*'
                 * @example 'www.domain.com'
                 * @example '/^(www.|)domain.(com|org)$/i'
                 */
                'host' => '*',

                /**
                 * Header 'Origin'
                 * Used for filtering simple and preflight requests.
                 * @example ''
                 * @example '*'
                 * @example 'https://www.domain.com'
                 * @example '/https?:\/\/www.domain.com$/i'
                 */
                'origin' => '',

                /**
                 * Used for filtering simple and preflight requests by uri.
                 * @example []
                 * @example ['*']
                 * @example ['/api/one', '/api/two']
                 * @example ['/^\/api\/(one|two)/i', '/api/three']
                 */
                'locations' => [],

                /**
                 * Used for filtering preflight requests (Access-Control-Request-Method)
                 * @example []
                 * @example ['*']
                 * @example ['COPY', 'DELETE', 'PUT']
                 */
                'methods' => [],

                /**
                 * Used for filtering preflight requests (Access-Control-Request-Headers)
                 * Can be empty array, contain list of allowed headers, or contain '*' element
                 * @example []
                 * @example ['*']
                 * @example ['One', 'Two']
                 */
                'headers' => [],
            ],

            /**
             * This options will be used for adding as headers to response
             * @see for additional information here: https://learn.javascript.ru/xhr-crossdomain
             */
            'cors_headers' => [
                /**
                 * Used in simple and preflight CORS requests
                 * Header Allow-Credentials.
                 * @example TRUE
                 * @example FALSE
                 */
                'allow_credentials' => FALSE,

                /**
                 * Used in preflight CORS requests
                 * Header Access-Control-Allow-Headers
                 * @example []
                 * @example ['Origin', 'Content-Type', 'X-Auth-Token', 'Authorization']
                 */
                'allowed_headers' => [],

                /**
                 * Used in preflight CORS requests
                 * Header Access-Control-Allow-Methods
                 * @example []
                 * @example ['GET', 'POST']
                 */
                'allowed_methods' => [],

                /**
                 * Used in simple and preflight CORS requests
                 * Header Access-Control-Max-Age
                 * @example 0 -- won't be set
                 * @example 86400
                 */
                'max_age' => 0
            ]
        ]
    ]
];