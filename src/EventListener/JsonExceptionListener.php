<?php

declare(strict_types=1);

namespace ViachViach\ExceptionHandler\EventListener;

use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use ViachViach\ExceptionHandler\Handler\ValidationExceptionHandler;

class JsonExceptionListener
{
    private ValidationExceptionHandler $handler;

    public function __construct(ValidationExceptionHandler $handler)
    {
        $this->handler = $handler;
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $response = $this->handler->handle($exception);

        $event->setResponse($response);
    }
}
