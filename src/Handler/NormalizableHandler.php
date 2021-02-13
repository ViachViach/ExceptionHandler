<?php

declare(strict_types=1);

namespace ViachViach\ExceptionHandler\Handler;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Exception\NotNormalizableValueException;
use Symfony\Component\Serializer\SerializerInterface;
use Throwable;
use ViachViach\Storage\DTO\ValidationExceptionInfo;

class NormalizableHandler implements HandlerInterface
{
    private SerializerInterface $serializer;
    private ExceptionHandler $handler;

    public function __construct(SerializerInterface $serializer, ExceptionHandler $handler)
    {
        $this->serializer = $serializer;
        $this->handler    = $handler;
    }

    public function handle(Throwable $exception): ?JsonResponse
    {
        if (!$exception instanceof NotNormalizableValueException) {
            $this->handler->handle($exception);
        }

        $data = new ValidationExceptionInfo();
        $data
            ->setName('Validation exception')
            ->setMessage($exception->getMessage())
        ;

        $result = $this->serializer->serialize($data, JsonEncoder::FORMAT);

        return new JsonResponse($result, JsonResponse::HTTP_BAD_REQUEST, [], true);
    }
}
