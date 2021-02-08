<?php

declare(strict_types=1);

namespace ViachViach\ExceptionHandler\Handler;

use Symfony\Component\HttpFoundation\JsonResponse;
use Throwable;

interface HandlerInterface
{
    public function handle(Throwable $exception): ?JsonResponse;
}
