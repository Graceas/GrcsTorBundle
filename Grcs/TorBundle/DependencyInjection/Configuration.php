<?php

namespace Grcs\TorBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('grcs_tor', 'array');

        $rootNode
            ->children()
                ->scalarNode('hostname')->defaultValue('127.0.0.1')->cannotBeEmpty()->end()
                ->scalarNode('port')->defaultValue('9050')->cannotBeEmpty()->end()
                ->scalarNode('control_port')->defaultValue('9051')->cannotBeEmpty()->end()
                ->scalarNode('timeout')->defaultValue('-1')->cannotBeEmpty()->end()
                ->scalarNode('authmethod')->defaultValue('-1')->cannotBeEmpty()->end()
            ->end();

        return $treeBuilder;
    }
}
