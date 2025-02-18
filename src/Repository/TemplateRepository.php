<?php

declare(strict_types=1);

namespace Brizy\Bundle\ApiEntitiesBundle\Repository;

use Brizy\Bundle\ApiEntitiesBundle\Entity\Template;
use Doctrine\Persistence\ManagerRegistry;
/**
 * Class TemplateRepository
 */
class TemplateRepository extends Common\EntityRepository
{
    /**
     * TemplateRepository constructor.
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Template::class);
    }
}
