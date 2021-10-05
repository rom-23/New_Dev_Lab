<?php

namespace App\Entity\Development;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Entity\User;
use App\Repository\Development\PostRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
#[ApiResource]
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user:get"})
     */
    private ?int $id = null;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:get"})
     */
    #[Assert\NotBlank]
    #[Assert\Length(min: 4)]
    private ?string $title;

    /**
     * @ORM\Column(type="text")
     * @Groups({"user:get"})
     */
    #[Assert\NotBlank]
    #[Assert\Length(min: 4)]
    private ?string $content;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"user:get"})
     */
    private \DateTime $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity=Development::class, inversedBy="posts")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private ?Development $development = null;

    /**
     * @var User
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="posts")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private User $author;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
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

    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getDevelopment(): ?Development
    {
        return $this->development;
    }

    public function setDevelopment(?Development $development): self
    {
        $this->development = $development;

        return $this;
    }

    public function __toString()
    {
        return $this->title;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;
        return $this;
    }
}
