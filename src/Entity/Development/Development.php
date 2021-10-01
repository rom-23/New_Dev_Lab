<?php

namespace App\Entity\Development;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\ApiPlatform\DevSectionController;
use App\Controller\ApiPlatform\DevUploadController;
use App\Repository\Development\DevelopmentRepository;
use DateTime;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity(repositoryClass=DevelopmentRepository::class)
 * @Vich\Uploadable
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
            'put',
            'document' => [
                'method'          => 'POST',
                'path'            => '/developments/{id}/document',
                'deserialize'     => false,
                'controller'      => DevUploadController::class,
                'openapi_context' => [
                    'requestBody' => [
                        'content' => [
                            'multipart/form-data' => [
                                'schema' => [
                                    'type'       => 'object',
                                    'properties' => [
                                        'file' => [
                                            'type'   => 'string',
                                            'format' => 'binary'
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ],
        attributes: [
            'order' => ['createdAt' => 'DESC']
        ],
        denormalizationContext: ['groups' => ['development:write'], 'enable_max_depth' => true],
        normalizationContext: ['groups' => ['development:read'], 'enable_max_depth' => true]
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
     * @ORM\Column(type="datetime")
     */
    #[Groups(['development:read'])]
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $filename;

    /**
     * @Vich\UploadableField(mapping="dev_documentation", fileNameProperty="filename")
     * @var File|null
     */
    private $file;

    /**
     * @var string|null
     */
    #[Groups(['development:read'])] // sert a obtenir l'url de l'image ( et non le chemin) pour l'API
    private $fileUrl;

    /**
     * @ORM\ManyToOne(targetEntity=Section::class, inversedBy="developments",cascade={"persist"})
     */
    #[Groups(['development:read', 'development:write'])]
    private $section;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="developments",cascade={"persist"})
     */
    private $tags;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
        $this->tags = new ArrayCollection();
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

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
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

    /**
     * @return File|null
     */
    public function getFile(): ?File
    {
        return $this->file;
    }

    /**
     * @param null|File $file
     * @return Development
     */
    public function setFile(?File $file): Development
    {
        $this->file = $file;
        if ($this->file instanceof UploadedFile) {
            $this->updatedAt = new \DateTime('now');
        }
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFileUrl(): ?string
    {
        return $this->fileUrl;
    }

    /**
     * @param string|null $fileUrl
     * @return Development
     */
    public function setFileUrl(?string $fileUrl): Development
    {
        $this->fileUrl = $fileUrl;
        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->contains($tag)) {
            $this->tags->removeElement($tag);
//            $option->removeModel($this);
        }

        return $this;
    }


}
