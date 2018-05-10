<?php

namespace App\Http\Middleware;

use Closure;

class CorsMiddleware {
  /**
   * Allow Cross-Origin Resource Sharing .
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next)
  {
    $response = $next($request);
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $response->headers->set('Access-Control-Allow-Methods', 'OPTIONS, GET, POST, PUT, DELETE');
    $response->headers->set('Access-Control-Allow-Headers', $request->header('Access-Control-Request-Headers'));
    return $response;
  }
}
