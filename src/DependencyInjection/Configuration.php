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
                ->arrayNode('attributes')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->booleanNode('user_id')->defaultTrue()->end()
                        ->booleanNode('email')->defaultFalse()->end()
                        ->booleanNode('name')->defaultTrue()->end()
                        ->booleanNode('signed_up_at')->defaultTrue()->end()
                        ->booleanNode('last_request_at')->defaultTrue()->end()
                        ->booleanNode('session_count')->defaultTrue()->end()
                        ->booleanNode('unsubscribed_from_emails')->defaultTrue()->end()
                        ->booleanNode('user_agent_data')->defaultTrue()->end()
                        ->booleanNode('location')->defaultTrue()->end()
                        ->booleanNode('social_profiles')->defaultTrue()->end()
                        ->arrayNode('custom_attributes')->prototype('scalar')->end()->end()
                        ->arrayNode('company')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->booleanNode('company_id')->defaultTrue()->end()
                                ->booleanNode('plan')->defaultTrue()->end()
                                ->booleanNode('monthly_spend')->defaultTrue()->end()
                                ->booleanNode('session_count')->defaultTrue()->end()
                                ->booleanNode('user_count')->defaultTrue()->end()
                                ->arrayNode('custom_attributes')->prototype('scalar')->end()->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
