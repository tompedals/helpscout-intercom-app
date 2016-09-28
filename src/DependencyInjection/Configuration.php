<?php

namespace TomPedals\HelpScoutApp\Intercom\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('intercom_app')
            ->children()
                ->scalarNode('app_id')->isRequired()->end()
                ->scalarNode('api_key')->isRequired()->end()
            ->end();

        return $treeBuilder;
    }
}