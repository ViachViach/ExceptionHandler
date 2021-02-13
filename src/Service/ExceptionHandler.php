<?php

declare(strict_types=1);

namespace ViachViach\ExceptionHandler\Service;

use Symfony\Component\HttpFoundation\JsonResponse;
use Throwable;
use ViachViach\ExceptionHandler\Handler\HandlerInterface;

final class ExceptionHandler implements ExceptionHandlerInterface
{
    /**
     * @var HandlerInterface[]
     */
    private array $handlers;

    public function addHandler(HandlerInterface $handle): void
    {
        $this->handlers[get_class($handle)] = $handle;
    }

    public function handle(Throwable $e): ?JsonResponse
    {
        return $handler->handle($e);
    }
}
