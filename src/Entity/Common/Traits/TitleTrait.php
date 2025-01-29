<?php

declare(strict_types=1);

namespace Brizy\Bundle\ApiEntitiesBundle\Entity\Common\Traits;

use App\Annotation\GraphQLType;
use App\Constants\WebhookConst;
use Doctrine\ORM\Mapping as ORM;

trait TitleTrait
{
    /**
     * @ORM\Column(type="string", length=120, nullable=false)
     */
    protected $title;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
}
