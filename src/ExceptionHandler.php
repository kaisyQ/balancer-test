<?php declare(strict_types=1);


namespace App;

use App\Application\Exceptions\ValidateException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

final class ExceptionHandler
{

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        
        $message = $exception->getMessage();

        $statusCode = Response::HTTP_INTERNAL_SERVER_ERROR;

        if ($exception instanceof ValidateException) {
            $statusCode = $exception->getCode();
        }

        $response = new JsonResponse([
            'error_message' => $message,
        ], $statusCode);

        $event->setResponse($response);
    }
}