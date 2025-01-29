<?php

declare(strict_types=1);

namespace Brizy\Bundle\ApiEntitiesBundle\Repository\Common;

interface VersionableEntityRepositoryInterface
{
    public function getEntityVersion(object $entity, string $property): int;
}
