<?php

declare(strict_types=1);

namespace ViachViach\ExceptionHandler\Handler;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;
use ViachViach\Storage\Exception\ValidationException;

class ValidationExceptionHandler
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function handle(Throwable $exception): ?JsonResponse
    {
        // TODO ALL exeption with debug
        if (!$exception instanceof ValidationException) {
            return null;
        }
        
        return new JsonResponse($exception->getValidationInfo(), JsonResponse::HTTP_NOT_FOUND, [], true);
    }
}
