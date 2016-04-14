<?php

namespace AuthBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('core');
        $rootNode->children()
                ->arrayNode('admins')
                    ->prototype('scalar')->end()
                ->end()
                ->arrayNode('persist')
                    ->children()
                        ->booleanNode('user')->defaultFalse()->end()
                        ->booleanNode('user_access_token')->defaultFalse()->end()
                    ->end()
                ->end()
            ->end()
        ;
        return $treeBuilder;
    }
}
