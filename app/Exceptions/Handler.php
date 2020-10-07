<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler {
    private const ENV_TEST = 'testing';

    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    public function register(){
        //
    }

    public function render($request, Throwable $exception){
        if(app()->environment() == self::ENV_TEST) throw $exception;

        return parent::render($request, $exception);
    }
}
