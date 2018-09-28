<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Auth\AuthenticationException;
use App\Exceptions\Traits\RestTrait;
use App\Exceptions\Traits\RestExceptionHandlerTrait;

class Handler extends ExceptionHandler
{

    /**
     * Trait bat loi api
     */
    use RestTrait;
    use RestExceptionHandlerTrait;


    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if($request->wantsJson()) {
            $retval = $this->getJsonResponseForException($request, $e);
            return $retval;
        }
        if ($e instanceof HttpException && $e->getStatusCode()== 401) {
            return response()->view('errors.401', ['message' => $e->getMessage()]);
        } 
        elseif ($e instanceof HttpException && $e->getStatusCode()== 404) {
            return response()->view('errors.404',['message' => $e->getMessage()]);
        }
        elseif ($e instanceof HttpException && $e->getStatusCode()== 403) {
            return response()->view('errors.403',['message' => $e->getMessage()]);
        }
            # code...
        return parent::render($request, $e);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }
        $guard = array_get($exception->guards(), 0);
        switch ($guard) {
          case 'admin':
            $login = 'admin.login';
            break;
          default:
            $login = 'login';
            break;
        }
        return redirect()->guest(route($login));
    }
}
