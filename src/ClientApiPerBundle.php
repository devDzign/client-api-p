<?php

declare(strict_types=1);

namespace InterInvest\ClientApiPer;

use InterInvest\Workflow\DependencyInjection\Configuration;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class ClientApiPerBundle extends AbstractBundle
{

    public function load(array $configs, ContainerBuilder $container): void
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../config'));
        $loader->load('services.yaml');
    }

}