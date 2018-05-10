<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;

use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        AuthorizationException::class,
        HttpException::class,
        ModelNotFoundException::class,
        ValidationException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        switch (true) {
          case $e instanceof \InvalidArgumentException : case $e instanceof \UnexpectedValueException :
          case $e instanceof \Firebase\JWT\SignatureInvalidException : case $e instanceof \Firebase\JWT\BeforeValidException :
          case $e instanceof \Firebase\JWT\ExpiredException :
            return response()->json(['error' => 'Your token is invalid.'], Response::HTTP_UNAUTHORIZED, ['Access-Control-Allow-Origin' => '*']); //=> 401
            break;
          case $e instanceof \Illuminate\Validation\ValidationException :
            return response()->json(['error' => 'Your dataset is invalid.'], Response::HTTP_BAD_REQUEST, ['Access-Control-Allow-Origin' => '*']); //=> 400
            break;
          case $e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException :
          case $e instanceof \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException :
          case $e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException :
            return response()->json(['error' => 'No resources are associated to this.'], Response::HTTP_NOT_IMPLEMENTED, ['Access-Control-Allow-Origin' => '*']); //=> 501
            break;
          default:
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR, ['Access-Control-Allow-Origin' => '*']); //=> 500
        }
        //=> https://github.com/symfony/http-foundation/blob/master/Response.php
    }
}
