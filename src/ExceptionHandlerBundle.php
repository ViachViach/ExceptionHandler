<?php

declare(strict_types=1);

namespace CustomValidationBundle;

use CustomValidationBundle\DependencyInjection\Compiler\HandlerPass;
use CustomValidationBundle\Handler\HandleInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class ExceptionHandlerBundle extends Bundle
{
    public const HANDLER_TAG = 'exception.handler';

    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container
            ->registerForAutoconfiguration(HandleInterface::class)
            ->addTag(self::HANDLER_TAG);

        $container->addCompilerPass(new HandlerPass());
    }

}
