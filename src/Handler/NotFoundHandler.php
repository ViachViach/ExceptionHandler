<?php

declare(strict_types=1);

namespace ViachViach\ExceptionHandler\Handler;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;
use ViachViach\ExceptionHandler\Exception\NotFoundException;

class NotFoundHandler implements HandlerInterface
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
