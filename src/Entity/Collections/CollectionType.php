<?php

declare(strict_types=1);

namespace Brizy\Bundle\ApiEntitiesBundle\Entity\Collections;


use Brizy\Bundle\ApiEntitiesBundle\Entity\Common\Traits as CommonTraits;
use Brizy\Bundle\ApiEntitiesBundle\Repository\Collections\CollectionTypeRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


#[ORM\Entity(
    repositoryClass: CollectionTypeRepository::class,
    readOnly: true
)]
#[ORM\Table(
    indexes: [
        new ORM\Index(columns: ["project_id", "priority"]),
    ],
    uniqueConstraints: [
        new ORM\UniqueConstraint(columns: ["project_id", "id"]),
        new ORM\UniqueConstraint(columns: ["project_id", "title"]),
        new ORM\UniqueConstraint(columns: ["project_id", "slug"]),
    ]
)]
#[UniqueEntity(fields: ["project", "title"], errorPath: "title")]
#[UniqueEntity(fields: ["project", "slug"], errorPath: "slug")]
class CollectionType
{
    use CommonTraits\IdTrait;
    use CommonTraits\CreatedAtTrait;
    use CommonTraits\ProjectTrait;
    use CommonTraits\PriorityTrait;
    use CommonTraits\TitleTrait;
    use CommonTraits\SettingsTrait;

    public const PUBLIC_DEFAULT_VALUE = true;
    public const SHOW_UI_DEFAULT_VALUE = true;
    public const SHOW_IN_MENU_DEFAULT_VALUE = true;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: "integer")]
    protected $id = null;

    #[ORM\Column(type: "string", length: 120, nullable: false)]
    protected $title;

    #[ORM\Column(type: "string", nullable: false)]
    private $slug = '';

    #[ORM\ManyToOne(targetEntity: CollectionEditor::class, fetch: "EAGER", inversedBy: "collectionTypes")]
    #[ORM\JoinColumn(nullable: true, onDelete: "SET NULL")]
    protected $editor;

    #[ORM\ManyToOne(targetEntity: CollectionCategory::class)]
    #[ORM\JoinColumn(nullable: true, onDelete: "SET NULL")]
    protected $category;

    #[ORM\OneToMany(
        targetEntity: CollectionTypeField::class,
        mappedBy: "collectionType",
        cascade: ["persist", "remove"],
        fetch: "EAGER"
    )]
    #[ORM\OrderBy(["priority" => "DESC"])]
    protected $fields;

    #[ORM\Column(type: "json", nullable: true)]
    protected $settings = [];

    #[ORM\OneToMany(targetEntity: \App\Entity\Template::class, mappedBy: "type")]
    private Collection $templates;

    #[ORM\Column(type: "boolean", nullable: false, options: ["default" => 1])]
    private bool $hasPreview = true;

    #[ORM\Column(type: "boolean", nullable: false, options: ["default" => CollectionType::PUBLIC_DEFAULT_VALUE])]
    private bool $public = self::PUBLIC_DEFAULT_VALUE;

    #[ORM\Column(type: "boolean", nullable: false, options: ["default" => CollectionType::PUBLIC_DEFAULT_VALUE])]
    private bool $showUI = self::SHOW_UI_DEFAULT_VALUE;

    #[ORM\Column(type: "boolean", nullable: false, options: ["default" => CollectionType::PUBLIC_DEFAULT_VALUE])]
    private bool $showInMenu = self::SHOW_IN_MENU_DEFAULT_VALUE;

    /**
     * CollectionType constructor.
     */
    public function __construct()
    {
        $this->createdAt = new DateTime();
        $this->fields = new ArrayCollection();
        $this->templates = new ArrayCollection();
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getEditor(): ?CollectionEditor
    {
        return $this->editor;
    }

    public function setEditor(?CollectionEditor $editor): self
    {
        $this->editor = $editor;

        return $this;
    }

    public function getCategory(): ?CollectionCategory
    {
        return $this->category;
    }

    public function setCategory(?CollectionCategory $category): self
    {
        $this->category = $category;

        return $this;
    }

    /**
     * @return Collection|CollectionTypeField[]
     */
    public function getFields(): Collection
    {
        return $this->fields;
    }

    public function setFields(iterable $collection): self
    {
        $this->fields = $collection;

        return $this;
    }

    public function getTemplates(): Collection
    {
        return $this->templates;
    }

    /**
     * @return CollectionType
     */
    public function setTemplates(Collection $templates): self
    {
        $this->templates = $templates;

        foreach ($this->templates as $template) {
            $template->setType($this);
        }

        return $this;
    }

    public function getSettings()
    {
        $settings = $this->settings ?: [];

        /*
         * Must be nonNull
         * @see \App\Type\GraphQL\Definition\CollectionTypeSettingsType::getSettingsFields
         */
        $settings['hidden'] = (bool)($settings['hidden'] ?? false);

        return $settings;
    }

    public function getHasPreview(): bool
    {
        return $this->hasPreview;
    }

    public function setHasPreview(bool $hasPreview): self
    {
        $this->hasPreview = $hasPreview;

        return $this;
    }

    public function getPublic(): ?bool
    {
        return $this->public;
    }

    public function setPublic(bool $public): self
    {
        $this->public = $public;

        return $this;
    }

    public function getShowUI(): ?bool
    {
        return $this->showUI;
    }

    public function setShowUI(bool $showUI): self
    {
        $this->showUI = $showUI;

        return $this;
    }

    public function getShowInMenu(): ?bool
    {
        return $this->showInMenu;
    }

    public function setShowInMenu(bool $showInMenu): self
    {
        $this->showInMenu = $showInMenu;

        return $this;
    }
}
