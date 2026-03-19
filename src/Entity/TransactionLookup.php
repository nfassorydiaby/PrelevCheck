<?php

declare(strict_types=1);

namespace App\Entity;

use App\Enum\ConfidenceLevel;
use App\Enum\LookupSource;
use App\Repository\TransactionLookupRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransactionLookupRepository::class)]
#[ORM\Table(name: 'transactions_lookup')]
#[ORM\Index(columns: ['normalized_input'], name: 'idx_normalized_input')]
#[ORM\Index(columns: ['slug'], name: 'idx_slug')]
class TransactionLookup
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    // Libellé brut tel que saisi par l'utilisateur (ex: "DRI*ADOBE 12345")
    #[ORM\Column(type: 'string', length: 255)]
    private string $rawInput;

    // Libellé normalisé pour la recherche (ex: "driadobe")
    #[ORM\Column(type: 'string', length: 255)]
    private string $normalizedInput;

    // Nom de l'entreprise identifiée (ex: "Adobe")
    #[ORM\Column(type: 'string', length: 255)]
    private string $companyName;

    // Description courte (ex: "Abonnement logiciel créatif")
    #[ORM\Column(type: 'text')]
    private string $description;

    // Catégorie (ex: "Logiciel", "Streaming", "Assurance"...)
    #[ORM\Column(type: 'string', length: 100, nullable: true)]
    private ?string $category = null;

    // Slug pour les pages SEO (ex: "adobe-creative-cloud")
    #[ORM\Column(type: 'string', length: 255, unique: true, nullable: true)]
    private ?string $slug = null;

    // Niveau de confiance de l'identification
    #[ORM\Column(type: 'string', length: 20, enumType: ConfidenceLevel::class)]
    private ConfidenceLevel $confidenceLevel;

    // Source ayant fourni le résultat
    #[ORM\Column(type: 'string', length: 20, enumType: LookupSource::class)]
    private LookupSource $source;

    // Nombre de fois que ce prélèvement a été recherché
    #[ORM\Column(type: 'integer', options: ['default' => 1])]
    private int $hitCount = 1;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $updatedAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    // ─── Getters & Setters ────────────────────────────────────────────────────

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRawInput(): string
    {
        return $this->rawInput;
    }

    public function setRawInput(string $rawInput): static
    {
        $this->rawInput = $rawInput;
        return $this;
    }

    public function getNormalizedInput(): string
    {
        return $this->normalizedInput;
    }

    public function setNormalizedInput(string $normalizedInput): static
    {
        $this->normalizedInput = $normalizedInput;
        return $this;
    }

    public function getCompanyName(): string
    {
        return $this->companyName;
    }

    public function setCompanyName(string $companyName): static
    {
        $this->companyName = $companyName;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;
        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): static
    {
        $this->category = $category;
        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): static
    {
        $this->slug = $slug;
        return $this;
    }

    public function getConfidenceLevel(): ConfidenceLevel
    {
        return $this->confidenceLevel;
    }

    public function setConfidenceLevel(ConfidenceLevel $confidenceLevel): static
    {
        $this->confidenceLevel = $confidenceLevel;
        return $this;
    }

    public function getSource(): LookupSource
    {
        return $this->source;
    }

    public function setSource(LookupSource $source): static
    {
        $this->source = $source;
        return $this;
    }

    public function getHitCount(): int
    {
        return $this->hitCount;
    }

    public function incrementHitCount(): static
    {
        $this->hitCount++;
        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): \DateTimeImmutable
    {
        return $this->updatedAt;
    }

    #[ORM\PreUpdate]
    public function onPreUpdate(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }
}