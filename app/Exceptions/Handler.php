<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
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
     * @param \Exception $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    //重写 Alex
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        $guards = $exception->guards();
//dd($guards);

        if ($request->expectsJson()) {
            return response()->json(['message' => $exception->getMessage()], 401);
        } else {
            $url= in_array('admin', $guards)?route('admin.login'):route('login') ;
            return redirect()->guest($url);
        }
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        /* 错误页面 */
        if ($exception instanceof NotFoundHttpException) {
            $code = $exception->getStatusCode();
            if (view()->exists('errors.'.$code)) {
                return response()->view('Errors.'.$exception->getStatusCode());
            }
        }

        return parent::render($request, $exception);
    }
}