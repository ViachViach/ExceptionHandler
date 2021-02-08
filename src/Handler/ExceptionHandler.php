<?php

declare(strict_types=1);

namespace ViachViach\ExceptionHandler\Handler;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;

class ExceptionHandler implements HandlerInterface
{
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function handle(Throwable $exception): ?JsonResponse
    {
        $result = $this->serializer->serialize($exception, JsonEncoder::FORMAT);

        return new JsonResponse($result, JsonResponse::HTTP_NOT_FOUND, [], true);
    }
}
