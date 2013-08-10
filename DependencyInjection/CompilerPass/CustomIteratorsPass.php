<?php

namespace WindowsAzure\DistributionBundle\DependencyInjection\CompilerPass;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * 
 */
class CustomIteratorsPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $deploymentDefinition = $container->getDefinition('windows_azure_distribution.deployment');
        $options = $deploymentDefinition->getArgument(2);
        
        if (!array_key_exists('customIterators', $options)) {
            $options['customIterators'] = array();
        }
        foreach ($container->findTaggedServiceIds('windows_azure_distribution.custom_iterator') as $serviceId) {
            $options['customIterators'][] = new Reference($serviceId);
        }
        
        $deploymentDefinition->replaceArgument(2, $options);
    }
}

