<?php

namespace Kpod13\CorsMaker;
use Closure;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsMakerHandler {

    /**
     * @var CorsMakerService
     */
    protected $corsMaker;

  /**
   * CorsMakerHandler constructor.
   */
    public function __construct() {
        $this->corsMaker = new CorsMakerService();
    }

  /**
   * @param Request $request
   * @param Closure $next
   *
   * @return Response
   */
    public function handle(Request $request, Closure $next): Response {
        $response = $next($request);

        // Add headers to response of simple crossdomain request
        if ($this->corsMaker->isSimpleCorsRequest($request)) {
            return $this->corsMaker->addSimpleCorsHeaders($request, $response);
        }

        // Add headers to response of preflight crossdomain request
        if ($this->corsMaker->isPrefliedCorsRequest($request)) {
            return $this->corsMaker->addPreflightCorsHeaders($request, $response);
        }

        return $response;
    }
}