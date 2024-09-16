<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

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
    public function render($request, Exception $exception)
    {
        // if ($this->isHttpException($exception)) {
        //     $reportData =array(
        //         'report' => $exception->getFile().'-'.$exception->getLine(),
        //         'pesan' => $exception->getMessage(),
        //         'agen' => $_SERVER['HTTP_USER_AGENT'],
        //         'reveral' => url()->previous(),
        //         'url' => url()->current(),                                                                                 
        //         'date' => Date('d-m-Y h:m'),                                                                                 
        //     );
        //     if ($exception->getStatusCode() == 404 || url()->previous()!='http://demo.jschina.test' || strpos(url()->current(), '.js') == false || strpos(url()->current(), '.css') == false) {
        //         send_error_report($reportData);
        //         return response()->view('errors.' . 'not-found', [], 404);
        //     }
        //     if ($exception->getStatusCode() == 500 || url()->previous()!='http://demo.jschina.test') {
        //         send_error_report($reportData);
        //         return response()->view('errors.' . 'error-500', [], 500);
        //     }
        // }
        // if ($exception instanceof \Illuminate\Session\TokenMismatchException) {
        //     return redirect('/');
        // }
        return parent::render($request, $exception);
    }
}
