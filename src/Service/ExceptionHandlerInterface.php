<?php

declare(strict_types=1);

namespace CustomValidationBundle\Service;

use Throwable;

interface ExceptionHandlerInterface
{
    public function handle(Throwable $e);
}
