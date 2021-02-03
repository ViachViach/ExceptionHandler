<?php

declare(strict_types=1);

namespace CustomValidationBundle\Handler;

use CustomValidationBundle\Exception\NotFoundException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;

class NotFoundHandle implements HandleInterface
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function handle(Throwable $exception): ?JsonResponse
    {
        if (!$exception instanceof NotFoundException) {
            return null;
        }

        $data = $this->serializer->serialize($exception, JsonEncoder::FORMAT);
        return new JsonResponse($data, JsonResponse::HTTP_NOT_FOUND, [], true);
    }
}
