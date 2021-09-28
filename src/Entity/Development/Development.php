<?php

namespace App\Entity\Development;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\ApiPlatform\DevSectionController;
use App\Repository\Development\DevelopmentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=DevelopmentRepository::class)
 */
#[
ApiResource(
    collectionOperations: [
        'get',
        'post',
        'get_by_section' => [
            'method'             => 'GET',
            'path'               => '/developments/section/{id}',
            'controller'         => DevSectionController::class,
            'read'               => false,
            'pagination_enabled' => false,
            'openapi_context'    => [
                'summary'    => 'Récupère la documentation relative à la section',
                'parameters' => [
                    [
                        'name'        => 'id',
                        'in'          => 'path',
                        'type'        => 'integer',
                        'required'    => true,
                        'description' => 'Filtre les documentations par section'
                    ]
                ],
                'responses'  => [
                    '200' => [
                        'description' => 'OK',
                        'content'     => [
                            'application/json' => [
                                'schema' => [
                                    'type'    => 'integer',
                                    'example' => 2
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ],
    itemOperations: [
        'get',
        'patch',
        'delete',
        'put'
    ],
    attributes: [
        'order' => ['createdAt' => 'DESC']
    ],
    denormalizationContext: ['groups' => ['development:write'], 'enable_max_depth' =>true],
    normalizationContext: ['groups' => ['development:read'], 'enable_max_depth' =>true]
)]
class Development
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    #[Groups(['development:read'])]
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    #[Groups(['development:read', 'development:write'])]
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    #[Groups(['development:read', 'development:write'])]
    private $content;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    #[Groups(['development:read'])]
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $filename;

    /**
     * @ORM\ManyToOne(targetEntity=Section::class, inversedBy="developments",cascade={"persist"})
     */
    #[Groups(['development:read', 'development:write'])]
    private $section;

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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param null|string $filename
     * @return Development
     */
    public function setFilename(?string $filename): Development
    {
        $this->filename = $filename;
        return $this;
    }

    public function getSection(): ?Section
    {
        return $this->section;
    }

    public function setSection(?Section $section): self
    {
        $this->section = $section;

        return $this;
    }
}
