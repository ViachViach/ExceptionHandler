<?php

declare(strict_types=1);

namespace ViachViach\ExceptionHandler\Handler;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;
use ViachViach\Storage\Exception\ValidationException;

class ValidationExceptionHandler
{
    private SerializerInterface $serializer;
    private NotFoundHandler $handler;

    public function __construct(SerializerInterface $serializer, NotFoundHandler $handler)
    {
        $this->serializer = $serializer;
        $this->handler    = $handler;
    }

    public function handle(Throwable $exception): JsonResponse
    {
        if (!$exception instanceof ValidationException) {
            return $this->handler->handle($exception);
        }
        
        return new JsonResponse($exception->getValidationInfo(), JsonResponse::HTTP_NOT_FOUND, [], true);
    }
}
