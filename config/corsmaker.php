<?php

return [
  'rules' => [
    [
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
  ]
];