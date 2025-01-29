<?php

declare(strict_types=1);

namespace Brizy\Bundle\ApiEntitiesBundle\Repository;

use App\Entity\CompiledScripts;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CompiledScripts|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompiledScripts|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompiledScripts[]    findAll()
 * @method CompiledScripts[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompiledScriptsRepository extends Common\EntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompiledScripts::class);
    }
}
