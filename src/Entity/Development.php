<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\DevelopmentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=DevelopmentRepository::class)
 */
#[ApiResource(
    denormalizationContext: ['groups' => ['post:write']],
    normalizationContext: ['groups' => ['post:read']]
)]
class Development
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['post:read'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['post:read', 'post:write'])]
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    #[Groups(['post:read', 'post:write'])]
    private $content;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    #[Groups(['post:read'])]
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
