<?php

declare(strict_types=1);

namespace ExceptionHandler\DependencyInjection\Compiler;

use ExceptionHandler\ExceptionHandlerBundle;
use ExceptionHandler\Service\ExceptionHandler;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class HandlerPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container): void
    {
        $definition = $container->findDefinition(ExceptionHandler::class);
        $handlers = $container->findTaggedServiceIds(ExceptionHandlerBundle::HANDLER_TAG);

        // phpcs:ignore SlevomatCodingStandard.Variables.UnusedVariable.UnusedVariable
        foreach ($handlers as $id => $tag) {
            $definition->addMethodCall('addHandler', [new Reference($id)]);
        }
    }
}
