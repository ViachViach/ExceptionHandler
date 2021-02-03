<?php

declare(strict_types=1);

namespace CustomValidationBundle\DependencyInjection\Compiler;

use CustomValidationBundle\ExceptionHandlerBundle;
use CustomValidationBundle\Service\Handlers;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class HandlerPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        $definition = $container->findDefinition(Handlers::class);
        $handlers = $container->findTaggedServiceIds(ExceptionHandlerBundle::HANDLER_TAG);

        foreach ($handlers as $id => $tag) {
            $definition->addMethodCall('addHandler', [new Reference($id)]);
        }
    }
}
