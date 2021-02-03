<?php

declare(strict_types=1);

namespace CustomValidationBundle\EventListener;

use CustomValidationBundle\Service\ExceptionHandlerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Exception\NotNormalizableValueException;
use Throwable;

class JsonExceptionListener
{
    private ExceptionHandlerInterface $exceptionHandler;

    public function __construct(ExceptionHandlerInterface $exceptionHandler)
    {
        $this->exceptionHandler = $exceptionHandler;
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $this->exceptionHandler->handle($exception);

        $this->handleNotFoundException($exception, $event);
        $this->handleNotNotNormalizableValueException($exception, $event);
    }

    private function handleNotNotNormalizableValueException(Throwable $exception, ExceptionEvent $event): void
    {
        if (!$exception instanceof NotNormalizableValueException) {
            return;
        }

        $response = new JsonResponse();
        $response->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);

        $data = new ValidationException();
        $data
            ->setMessage($exception->getMessage())
            ->setCode(JsonResponse::HTTP_BAD_REQUEST)
        ;


        $data = $this->serializer->serialize($data, JsonEncoder::FORMAT);
        $response->setJson($data);

        $event->setResponse($response);
    }

    private function handleNotFoundException(Throwable $exception, ExceptionEvent $event): void
    {
        if (!$exception instanceof EntityNotFoundException) {
            return;
        }

        $response = new JsonResponse();
        $response->setStatusCode(JsonResponse::HTTP_NOT_FOUND);

        $data = new NotFoundException();
        $data
            ->setMessage($exception->getMessage())
            ->setCode(JsonResponse::HTTP_NOT_FOUND)
        ;


        $data = $this->serializer->serialize($data, JsonEncoder::FORMAT);
        $response->setJson($data);

        $event->setResponse($response);
    }
}
