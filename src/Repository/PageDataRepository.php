<?php

declare(strict_types=1);

namespace Brizy\Bundle\ApiEntitiesBundle\Repository;

use Brizy\Bundle\ApiEntitiesBundle\Entity\PageData;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @method PageData|null find($id, $lockMode = null, $lockVersion = null)
 * @method PageData|null findOneBy(array $criteria, array $orderBy = null)
 * @method PageData[]    findAll()
 * @method PageData[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PageDataRepository extends Common\EntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PageData::class);
    }

}
