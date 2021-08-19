<?php

namespace App\Exceptions;

use App\Http\Controllers\Api\ApiController;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

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
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {

        });
    }

    public function render($request, Throwable $exception)
    {
        if ($request->wantsJson()) {
            return $this->handleApiException($request, $exception);
        }
        return parent::render($request, $exception);
    }

    private function handleApiException($request, $exception)
    {
        switch (true) {
            case $exception instanceof QueryException:
                return $this->responder([
                    'error' => true,
                    'message' => 'Something went wrong.',
                ], 500);
            case $exception instanceof ValidationException:
                return $this->parseValidationErrorResponse($exception);
            case $exception instanceof ModelNotFoundException:
            case $exception instanceof NotFoundHttpException:
                return $this->responder([
                    'error' => true,
                    'message' => 'Resource not available.',
                ], 404);
            case $exception instanceof MethodNotAllowedHttpException:
                $message = 'Method now allowed.';
            case $exception instanceof HttpException:
                $statusCode = $exception->getStatusCode();
                $message = $message ?? $exception->getMessage();
                $headers = $exception->getHeaders() ?: [];

                return $this->responder([
                    'error' => true,
                    'message' => $message,
                ], $statusCode, $headers);
            default:
                $data = [
                    'error' => true,
                    'message' => 'Something went wrong',
                ];
                $statusCode = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500;

                return $this->responder($data, $statusCode);
        }
    }

    private function responder($data, $statusCode, array $headers = [])
    {
        return app(ApiController::class)->respondError($data, $statusCode, $headers);
    }

    private function parseValidationErrorResponse(Throwable $exception)
    {
        $errors = [];
        $statusCode = 422;
        if ($exception instanceof ValidationException) {
            $errors = $exception->errors();
        }
        $chopped = [];
        foreach ($errors as $key => $error) {
            $chopped[$key] = $error[0];
        }

        return $this->responder(['error' => true, 'causes' => $chopped], $statusCode);
    }
}
