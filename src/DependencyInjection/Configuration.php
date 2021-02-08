<?php

declare(strict_types=1);

namespace ViachViach\ExceptionHandler\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

final class Configuration implements ConfigurationInterface
{

    public function getConfigTreeBuilder(): TreeBuilder
    {
        return new TreeBuilder('exception_handler');
    }
}
