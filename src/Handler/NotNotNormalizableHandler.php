<?php

declare(strict_types=1);

namespace ExceptionHandler\Handler;

use ExceptionHandler\Exception\ValidationException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Exception\NotNormalizableValueException;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;

class NotNotNormalizableHandler implements HandlerInterface
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function handle(Throwable $exception): ?JsonResponse
    {
        if (!$exception instanceof NotNormalizableValueException) {
            return null;
        }

        $data = new ValidationException($exception->getMessage());
        $result = $this->serializer->serialize($data, JsonEncoder::FORMAT);

        return new JsonResponse($result, JsonResponse::HTTP_NOT_FOUND, [], true);
    }
}
