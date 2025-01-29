<?php

declare(strict_types=1);
namespace Brizy\Bundle\ApiEntitiesBundle\Repository\Collections;

use Brizy\Bundle\ApiEntitiesBundle\Entity\Collections\CollectionItem;
use Brizy\Bundle\ApiEntitiesBundle\Entity\Collections\CollectionItemField;
use Brizy\Bundle\ApiEntitiesBundle\Entity\Collections\CollectionTypeField;
use Brizy\Bundle\ApiEntitiesBundle\Repository\Common\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CollectionItemField|null find($id, $lockMode = null, $lockVersion = null)
 * @method CollectionItemField|null findOneBy(array $criteria, array $orderBy = null)
 * @method CollectionItemField[]    findAll()
 * @method CollectionItemField[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CollectionItemFieldRepository extends EntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CollectionItemField::class);
    }

    public function findOneBySlug(CollectionItem $item, string $slug): ?CollectionItemField
    {
        return $this->createQueryBuilder('f')
                    ->select('f')
                    ->innerJoin('f.type', 't', 'WITH', 't.slug = :slug')
                    ->andWhere('f.item = :item')
                    ->setMaxResults(1)
                    ->setParameter('item', $item)
                    ->setParameter('slug', $slug)
                    ->getQuery()
                    ->getOneOrNullResult();
    }

    public function checkIfExistsByValuesAndType(array $values, CollectionTypeField $field): ?bool
    {
        /**
         * fixme: does it make sense to index this field if search value is dynamic (no exact/hardcoded JSON prop) ?
         *
         * I think we can create a few virtual(generated) columns for the JSON values -> value, values -> id, and etc and create index by collection_item_field.type_id and generated column from JSON data, due to the fact that we searching by following columns, i think it will improve performance
         * https://dev.mysql.com/doc/refman/8.0/en/create-table-secondary-indexes.html
         * MySQL for JSON: https://www.compose.com/articles/mysql-for-json-generated-columns-and-indexing/#:~:text=MySQL%20doesn't%20have%20a,JSON%20values%2C%20at%20least%20directly.
         */
        $result = $this->createQueryBuilder('f')
                       ->select('f')
                       ->where('f.type = :type')
                       ->andWhere('JSON_CONTAINS(f.values, :values) = 1')
                       ->setParameter('type', $field->getId())
                       ->setParameter('values', json_encode($values))
                       ->getQuery()
                       ->setMaxResults(1)
                       ->getOneOrNullResult();

        return (bool) $result;
    }

    public function getCountByCollectionTypeField(CollectionTypeField $collectionTypeField): int
    {
        return (int) $this->createQueryBuilder('i')
                         ->select('count(i.id)')
                         ->join('i.type', 'f')
                         ->where('f.id=:id')
                         ->setParameters(['id' => $collectionTypeField->getId()])
                         ->getQuery()
                         ->getSingleScalarResult();
    }

    /**
     * @return iterable<int>
     */
    public function getByCollectionTypeField(CollectionTypeField $collectionTypeField): iterable
    {
        $result = $this->createQueryBuilder('i')
                       ->select('i.id')
                       ->join('i.type', 'f')
                       ->where('f.id=:id')
                       ->setParameters(['id' => $collectionTypeField->getId()])
                       ->getQuery()
                       ->getScalarResult();

        return array_column($result, 'id');
    }

    /**
     * @return iterable<CollectionItemField>
     */
    public function getByCollectionTypeFieldSlug(string $collectionTypeFieldSlug, int $project): iterable
    {
        return $this->createQueryBuilder('i')
                       ->join('i.type', 'f')
                       ->where('f.slug=:slug and f.project=:project')
                       ->setParameters(['slug' => $collectionTypeFieldSlug, 'project' => $project])
                       ->getQuery()
                       ->getResult();
    }

}
