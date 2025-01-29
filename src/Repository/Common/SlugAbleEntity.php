<?php

declare(strict_types=1);

namespace Brizy\Bundle\ApiEntitiesBundle\Repository\Common;

use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

trait SlugAbleEntity
{
    /**
     * @param $groupId
     */
    public function getSimilarSlugs(string $slugString, string $slugProperty, string $groupProperty, $groupId, $excludeId = null): array
    {
        /**
         * @var QueryBuilder $qb;
         */
        $qb = $this->createQueryBuilder('s');
        $qb->select("s.{$slugProperty}")
           ->where($qb->expr()->like("s.{$slugProperty}", ':slug'))
           ->andWhere("s.{$groupProperty}=:group")
           ->setParameters(['slug' => "{$slugString}%", 'group' => $groupId]);

        if ($excludeId) {
            $qb->andWhere('s.id <> :id')
                ->setParameter('id', (int) $excludeId);
        }

        $query = $qb->getQuery()->setHydrationMode(Query::HYDRATE_ARRAY);
        $result = $query->getArrayResult();

        return array_column($result, 'slug');
    }
}
