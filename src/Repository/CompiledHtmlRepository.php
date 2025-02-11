<?php

declare(strict_types=1);

namespace Brizy\Bundle\ApiEntitiesBundle\Repository;

use Brizy\Bundle\ApiEntitiesBundle\Entity\CompiledHtml;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CompiledHtml|null find($id, $lockMode = null, $lockVersion = null)
 * @method CompiledHtml|null findOneBy(array $criteria, array $orderBy = null)
 * @method CompiledHtml[]    findAll()
 * @method CompiledHtml[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CompiledHtmlRepository extends Common\EntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CompiledHtml::class);
    }
}
