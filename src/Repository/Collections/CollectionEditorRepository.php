<?php

declare(strict_types=1);

namespace Brizy\Bundle\ApiEntitiesBundle\Repository\Collections;

use Brizy\Bundle\ApiEntitiesBundle\Entity\Collections\CollectionEditor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CollectionEditor|null find($id, $lockMode = null, $lockVersion = null)
 * @method CollectionEditor|null findOneBy(array $criteria, array $orderBy = null)
 * @method CollectionEditor[]    findAll()
 * @method CollectionEditor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CollectionEditorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CollectionEditor::class);
    }

}
