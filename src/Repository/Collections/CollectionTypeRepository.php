<?php

declare(strict_types=1);

namespace Brizy\Bundle\ApiEntitiesBundle\Repository\Collections;

use Brizy\Bundle\ApiEntitiesBundle\Entity\Collections\CollectionEditor;
use Brizy\Bundle\ApiEntitiesBundle\Entity\Collections\CollectionType;
use Brizy\Bundle\ApiEntitiesBundle\Repository\Common\SlugAbleEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CollectionType|null find($id, $lockMode = null, $lockVersion = null)
 * @method CollectionType|null findOneBy(array $criteria, array $orderBy = null)
 * @method CollectionType[]    findAll()
 * @method CollectionType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CollectionTypeRepository extends ServiceEntityRepository
{
    use SlugAbleEntity;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CollectionType::class);
    }

    public function getCountByCollectionEditor(CollectionEditor $collectionEditor): int
    {
        return (int) $this->createQueryBuilder('i')
                         ->select('count(i.id)')
                         ->join('i.editor', 'e')
                         ->where('e.id=:id')
                         ->setParameters(['id' => $collectionEditor->getId()])
                         ->getQuery()
                         ->getSingleScalarResult();
    }

    /**
     * @return iterable<int>
     */
    public function getByCollectionEditor(CollectionEditor $collectionEditor): iterable
    {
        $result = $this->createQueryBuilder('i')
                    ->select('i.id')
                    ->join('i.editor', 'e')
                    ->where('e.id=:id')
                    ->setParameters(['id' => $collectionEditor->getId()])
                    ->getQuery()
                    ->getScalarResult();

        return array_column($result, 'id');
    }
}
