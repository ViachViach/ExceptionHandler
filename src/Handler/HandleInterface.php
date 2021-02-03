<?php

declare(strict_types=1);

namespace CustomValidationBundle\Handler;

use Symfony\Component\HttpFoundation\JsonResponse;
use Throwable;

interface HandleInterface
{
    public function handle(Throwable $exception): ?JsonResponse;
}
