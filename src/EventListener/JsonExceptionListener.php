<?php

declare(strict_types=1);

namespace ViachViach\ExceptionHandler\EventListener;

use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use ViachViach\ExceptionHandler\Service\ExceptionHandlerInterface;

class JsonExceptionListener
{
    private ExceptionHandlerInterface $exceptionHandler;

    public function __construct(ExceptionHandlerInterface $exceptionHandler)
    {
        $this->exceptionHandler = $exceptionHandler;
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();

        $response = $this->exceptionHandler->handle($exception);

        $event->setResponse($response);
    }
}
