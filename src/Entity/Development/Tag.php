<?php

namespace App\Entity\Development;

use App\Repository\Development\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Development::class, mappedBy="tags")
     */
    private $developments;

    #[Pure]
    public function __construct()
    {
        $this->developments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Development[]
     */
    public function getDevelopments(): Collection
    {
        return $this->developments;
    }

    public function addDevelopment(Development $development): self
    {
        if (!$this->developments->contains($development)) {
            $this->developments[] = $development;
            $development->addTag($this);
        }

        return $this;
    }

    public function removeDevelopment(Development $development): self
    {
        if ($this->developments->removeElement($development)) {
            $development->removeTag($this);
        }

        return $this;
    }
    public function __toString()
    {
        return $this->getName();
    }

}
