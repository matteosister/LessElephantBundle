<?php

namespace Cypress\LessElephantBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('cypress_less_elephant');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.

        $rootNode
            ->children()
                ->arrayNode('less_projects')
                    ->requiresAtLeastOneElement()
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode('source_folder')->isRequired()->end()
                            ->scalarNode('source_file')->isRequired()->end()
                            ->scalarNode('destination_css')->isRequired()->end()
                        ->end()
                    ->end()
                ->end()
                ->scalarNode('less_binary_path')->defaultValue(null)->end()
                ->scalarNode('force_compile')->defaultValue(false)->end()
            ->end()
        ;


        return $treeBuilder;
    }
}
