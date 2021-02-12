<?php

declare(strict_types=1);

namespace ViachViach\ExceptionHandler\Exception;

use Symfony\Component\HttpFoundation\JsonResponse;

class ValidationException extends AbstractException
{
    public function __construct(string $message="")
    {
        parent::__construct($message, JsonResponse::HTTP_BAD_REQUEST);
    }
}
