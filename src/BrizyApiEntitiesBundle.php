<?php

namespace Brizy\Bundle\ApiEntitiesBundle;

use Brizy\Bundle\ApiEntitiesBundle\DependencyInjection\BrizyApiEntitiesBundleExtension;
use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class BrizyApiEntitiesBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function getContainerExtension(): ?ExtensionInterface
    {
        return new BrizyApiEntitiesBundleExtension();
    }

    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $this->configureDoctrineExtension($container);
    }

    private function configureDoctrineExtension(ContainerBuilder $container): void
    {
        if (class_exists(DoctrineOrmMappingsPass::class)) {
            $namespaces = ['Brizy\Bundle\ApiEntitiesBundle\Entity'];
            $directories = [realpath(__DIR__ . '/Entity')];
            $managerParameters = [BrizyApiEntitiesBundleExtension::DOCTRINE_MANAGER];
            $enabledParameter = BrizyApiEntitiesBundleExtension::DOCTRINE_MAPPING;

            $container->addCompilerPass(
                DoctrineOrmMappingsPass::createAttributeMappingDriver(
                    $namespaces,
                    $directories,
                    $managerParameters,
                    false,
                    [],
                    true
                ), \Symfony\Component\DependencyInjection\Compiler\PassConfig::TYPE_BEFORE_OPTIMIZATION, 0
            );
        }
    }
}
