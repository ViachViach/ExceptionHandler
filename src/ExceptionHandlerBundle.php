<?php

declare(strict_types=1);

namespace ExceptionHandler;

use ExceptionHandler\DependencyInjection\Compiler\HandlerPass;
use ExceptionHandler\Handler\HandlerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ExceptionHandlerBundle extends Bundle
{
    public const HANDLER_TAG = 'exception.handler';

    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container
            ->registerForAutoconfiguration(HandlerInterface::class)
            ->addTag(self::HANDLER_TAG);

        $container->addCompilerPass(new HandlerPass());
    }
}
