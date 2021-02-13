<?php

declare(strict_types=1);

namespace ViachViach\ExceptionHandler\Handler;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;
use ViachViach\Storage\Exception\NotFoundException;

class NotFoundHandler implements HandlerInterface
{
    private SerializerInterface $serializer;
    private NormalizableHandler $handler;

    public function __construct(SerializerInterface $serializer, NormalizableHandler $handler)
    {
        $this->serializer = $serializer;
        $this->handler    = $handler;
    }

    public function handle(Throwable $exception): ?JsonResponse
    {
        if (!$exception instanceof NotFoundException) {
            $this->handler->handle($exception);
        }

        $data = $this->serializer->serialize($exception, JsonEncoder::FORMAT);

        return new JsonResponse($data, JsonResponse::HTTP_NOT_FOUND, [], true);
    }
}
