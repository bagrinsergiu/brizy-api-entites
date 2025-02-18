<?php

declare(strict_types=1);

namespace Brizy\Bundle\ApiEntitiesBundle\Entity\Collections;


use Brizy\Bundle\ApiEntitiesBundle\Entity\Common\Traits as CommonTraits;
use Brizy\Bundle\ApiEntitiesBundle\Repository\Collections\CollectionCategoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Index;

#[ORM\Entity(repositoryClass: CollectionCategoryRepository::class, readOnly: true)]
#[ORM\Table(
    indexes: [
        new ORM\Index(columns: ["project_id", "priority"])
    ],
    uniqueConstraints: []
)]
class CollectionCategory
{
    use CommonTraits\IdTrait;
    use CommonTraits\CreatedAtTrait;
    use CommonTraits\ProjectTrait;
    use CommonTraits\PriorityTrait;
    use CommonTraits\TitleTrait;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }
}
