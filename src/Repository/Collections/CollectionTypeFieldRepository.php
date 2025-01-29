<?php

declare(strict_types=1);

namespace Brizy\Bundle\ApiEntitiesBundle\Repository\Collections;

use Brizy\Bundle\ApiEntitiesBundle\Entity\Collections\CollectionType;
use Brizy\Bundle\ApiEntitiesBundle\Entity\Collections\CollectionTypeField;
use Brizy\Bundle\ApiEntitiesBundle\Repository\Common\SlugAbleEntity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CollectionTypeField|null find($id, $lockMode = null, $lockVersion = null)
 * @method CollectionTypeField|null findOneBy(array $criteria, array $orderBy = null)
 * @method CollectionTypeField[]    findAll()
 * @method CollectionTypeField[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CollectionTypeFieldRepository extends ServiceEntityRepository
{
    use SlugAbleEntity;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CollectionTypeField::class);
    }

    public function getReferenceFieldByCollectionType(CollectionType $collectionType)
    {
        return $this->createQueryBuilder('f')
                    ->where('JSON_EXTRACT(f.settings, :path) = :ctiri ')
                    ->andWhere('f.collectionType <> :currentField')
                    ->setParameter('currentField', $collectionType->getId())
                    ->setParameter('path', '$.collectionType')
                    ->setParameter('ctiri', '/collection_types/'.$collectionType->getId())
                    ->getQuery()
                    ->getResult();
    }
}
