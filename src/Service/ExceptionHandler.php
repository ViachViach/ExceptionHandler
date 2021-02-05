<?php

declare(strict_types=1);

namespace ExceptionHandler\Service;

use ExceptionHandler\Handler\HandlerInterface;

use Symfony\Component\HttpFoundation\JsonResponse;
use Throwable;

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
        foreach ($this->handlers as $handler) {
            $response = $handler->handle($e);

            if ($response !== null) {
                return $response;
            }
        }

        return null;
    }
}
