<?php

namespace TomPedals\HelpScoutApp\Intercom\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

class IntercomAppExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->getDefinition('intercom_app.handler')
            ->replaceArgument(2, $config['app_id'])
            ->replaceArgument(3, $config['attributes']);

        $container->getDefinition('intercom_app.client')
            ->replaceArgument(0, $config['app_id'])
            ->replaceArgument(1, $config['api_key']);
    }
}
