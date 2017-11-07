<?php

namespace Kpod13\CorsMaker;
use Closure;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Kpod13\CorsMaker\CorsMakerService;


class CorsMakerHandler {

    /**
     * @var CorsMakerService
     */
    protected $corsMaker;

    public function __construct() {
        $this->corsMaker = new CorsMakerService();
    }

    public function handle(Request $request, Closure $next) {
        $response = $next($request);
        // Manage CORS if it is CORS request
        if ($this->corsMaker->isCorsRequest($request)) {
            return $this->corsMaker->addCorsHeaders($request, $response);
        }

        return $response;
    }
}