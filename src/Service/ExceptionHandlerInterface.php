<?php

declare(strict_types=1);

namespace ViachViach\ExceptionHandler\Service;

use Symfony\Component\HttpFoundation\JsonResponse;
use Throwable;

interface ExceptionHandlerInterface
{
    public function handle(Throwable $e): void;
}
