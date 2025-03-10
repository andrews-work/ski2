<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestLogger
{
    public function handle($request, Closure $next)
    {
        // Log the incoming request
        $this->logRequest($request);

        // Measure the start time
        $startTime = microtime(true);

        // Process the request and get the response
        $response = $next($request);

        // Measure the end time
        $endTime = microtime(true);

        // Log the outgoing response
        $this->logResponse($request, $response, $startTime, $endTime);

        return $response;
    }

    protected function logRequest(Request $request)
    {
        // Log::info('Request:', [
        //     'method' => $request->method(),
        //     'url' => $request->fullUrl(),
        //     'headers' => $request->headers->all(),
        //     'payload' => $request->all(),
        // ]);
    }

    protected function logResponse(Request $request, Response $response, $startTime, $endTime)
    {
        $duration = $endTime - $startTime;

        // Log::info('Response:', [
        //     'status' => $response->getStatusCode(),
        //     'headers' => $response->headers->all(),
        //     'content' => $response->getContent(),
        //     'duration_ms' => $duration * 1000, // Convert to milliseconds
        // ]);
    }
}
