<?php

declare(strict_types=1);

namespace Brizy\Bundle\ApiEntitiesBundle\Repository;

use Brizy\Bundle\ApiEntitiesBundle\Entity\CompiledStyles;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CompiledStyles|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompiledStyles|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompiledStyles[]    findAll()
 * @method CompiledStyles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompiledStylesRepository extends Common\EntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompiledStyles::class);
    }
}
