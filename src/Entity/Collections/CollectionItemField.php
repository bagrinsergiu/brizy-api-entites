<?php

declare(strict_types=1);

namespace Brizy\Bundle\ApiEntitiesBundle\Entity\Collections;

use Brizy\Bundle\ApiEntitiesBundle\Entity\Common\Traits as CommonTraits;
use Brizy\Bundle\ApiEntitiesBundle\Repository\Collections\CollectionItemFieldRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(
    repositoryClass: CollectionItemFieldRepository::class,
    readOnly: true
)]
#[ORM\Table(
    indexes: [
        new ORM\Index(columns: ["project_id", "item_id"])
    ],
    uniqueConstraints: [
        new ORM\UniqueConstraint(columns: ["item_id", "type_id"]),
        new ORM\UniqueConstraint(columns: ["project_id", "type_id", "id"]),
        new ORM\UniqueConstraint(columns: ["project_id", "item_id", "type_id"])
    ]
)]
class CollectionItemField
{
    use CommonTraits\IdTrait;
    use CommonTraits\ProjectTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    protected $id;

    #[ORM\ManyToOne(targetEntity: CollectionItem::class, inversedBy: "fields")]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    protected $item;

    #[ORM\ManyToOne(targetEntity: CollectionTypeField::class, fetch: "EAGER")]
    #[ORM\JoinColumn(nullable: false, onDelete: "CASCADE")]
    protected $type;

    #[ORM\Column(name: "values", type: "json", nullable: true)]
    protected $values = [];

    #[ORM\ManyToOne(targetEntity: CollectionItem::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: "SET NULL")]
    protected $reference;

    #[ORM\ManyToMany(targetEntity: CollectionItem::class)]
    #[ORM\JoinTable(name: "collection_item_field_multi_reference")]
    protected $multiReference;

    public function __construct()
    {
        $this->multiReference = new ArrayCollection();
    }

    /**
     * @return Collection|CollectionItem[]
     */
    public function getMultiReference(): Collection
    {
        return $this->multiReference;
    }

    public function setMultiReference(Collection $multiReference): self
    {
        $this->multiReference = $multiReference;

        return $this;
    }

    public function getItem(): CollectionItem
    {
        return $this->item;
    }

    public function setItem(?CollectionItem $item): self
    {
        $this->item = $item;

        return $this;
    }

    public function getType(): ?CollectionTypeField
    {
        return $this->type;
    }

    public function setType(?CollectionTypeField $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getValues(): array
    {
        return $this->values ?: [];
    }

    public function setValues(?array $values = []): self
    {
        $this->values = $values;

        return $this;
    }

    public function getReference(): ?CollectionItem
    {
        return $this->reference;
    }

    public function setReference(?CollectionItem $reference): self
    {
        $this->reference = $reference;

        return $this;
    }
}
