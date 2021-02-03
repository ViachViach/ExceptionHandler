<?php

declare(strict_types=1);

namespace CustomValidationBundle\Service;

use CustomValidationBundle\Handler\HandleInterface;

use Symfony\Component\HttpFoundation\JsonResponse;
use Throwable;

final class ExceptionHandler implements ExceptionHandlerInterface
{
    /**
     * @var HandleInterface[];
    */
    private array $handlers;

    public function addHandler(HandleInterface $handle): void
    {
        $this->handlers[get_class($handle)] = $handle;
    }

    public function handle(Throwable $e): JsonResponse
    {
        foreach ($this->handlers as $handler) {
            $response = $handler->handle($e);

            if ($response !== null) {
                return $response;
            }
        }
    }
}
