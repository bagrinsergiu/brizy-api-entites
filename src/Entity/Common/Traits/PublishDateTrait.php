<?php

declare(strict_types=1);

namespace Brizy\Bundle\ApiEntitiesBundle\Entity\Common\Traits;

use App\Annotation\GraphQLType;
use App\Constants\WebhookConst;
use Doctrine\ORM\Mapping as ORM;

trait PublishDateTrait
{
    /**
     * @var \DateTimeInterface
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $publishDate = null;

    public function getPublishDate(): ?\DateTimeInterface
    {
        return $this->publishDate;
    }

    /**
     * @return PublishDateTrait
     */
    public function setPublishDate(?\DateTimeInterface $publishDate): self
    {
        $this->publishDate = $publishDate;

        return $this;
    }
}
