<?php

declare(strict_types=1);

namespace Brizy\Bundle\ApiEntitiesBundle\Repository\Collections;

use Brizy\Bundle\ApiEntitiesBundle\Entity\Collections\CollectionItem;
use Brizy\Bundle\ApiEntitiesBundle\Entity\Collections\CollectionType;
use Brizy\Bundle\ApiEntitiesBundle\Repository\Common\EntityRepository;
use Brizy\Bundle\ApiEntitiesBundle\Repository\Common\SlugAbleEntity;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CollectionItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method CollectionItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method CollectionItem[]    findAll()
 * @method CollectionItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CollectionItemRepository extends EntityRepository
{
    use SlugAbleEntity;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CollectionItem::class);
    }

    /**
     * @return array<CollectionItem>
     */
    public function gasItemsWithReferenceTo(CollectionItem $item, CollectionType $collectionType = null): array
    {
        $qb = $this->createQueryBuilder('ci')
            ->select('ci.id')
            ->join('ci.fields', 'if')
            ->leftjoin('if.multiReference', 'mr')
            ->where('(if.reference=:id1 or mr.id=:id2)')
            ->setParameters(['id1' => $item->getId(), 'id2' => $item->getId()]);

        if ($collectionType) {
            $qb->andWhere('(ci.type=:id3)')
                ->setParameter('id3', $collectionType);
        }

        $result = $qb->getQuery()->getScalarResult();

        return array_column($result, 'id', 0);
    }

    public function getCountByCollectionType(CollectionType $collectionType): int
    {
        $singleScalarResult = $this->createQueryBuilder('i')
            ->select('count(i.id)')
            ->join('i.type', 't')
            ->where('t.id=:id')
            ->setParameters(['id' => $collectionType->getId()])
            ->getQuery()
            ->getSingleScalarResult();

        return (int) $singleScalarResult;
    }

    /**
     * @return iterable<int>
     */
    public function getByCollectionType(CollectionType $collectionType): iterable
    {
        $result = $this->createQueryBuilder('i')
            ->select('i.id')
            ->join('i.type', 't')
            ->where('t.id=:id')
            ->setParameters(['id' => $collectionType->getId()])
            ->getQuery()
            ->getScalarResult();

        return array_column($result, 'id', 0);
    }

}
