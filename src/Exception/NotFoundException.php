<?php

declare(strict_types=1);

namespace CustomValidationBundle\Exception;

use Symfony\Component\HttpFoundation\JsonResponse;

class NotFoundException extends AbstractException
{
    public function __construct($message = "")
    {
        parent::__construct($message, JsonResponse::HTTP_NOT_FOUND);
    }
}
