<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\SearchLogRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SearchLogRepository::class)]
#[ORM\Table(name: 'search_logs')]
#[ORM\Index(columns: ['created_at'], name: 'idx_search_log_created_at')]
class SearchLog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    // Requête brute saisie par l'utilisateur
    #[ORM\Column(type: 'string', length: 255)]
    private string $query;

    // Résultat trouvé ou non
    #[ORM\Column(type: 'boolean', options: ['default' => false])]
    private bool $found = false;

    // Durée de traitement en millisecondes
    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $durationMs = null;

    // Adresse IP anonymisée (3 premiers octets uniquement)
    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private ?string $ipAnonymized = null;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    // ─── Getters & Setters ────────────────────────────────────────────────────

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuery(): string
    {
        return $this->query;
    }

    public function setQuery(string $query): static
    {
        $this->query = $query;
        return $this;
    }

    public function isFound(): bool
    {
        return $this->found;
    }

    public function setFound(bool $found): static
    {
        $this->found = $found;
        return $this;
    }

    public function getDurationMs(): ?int
    {
        return $this->durationMs;
    }

    public function setDurationMs(?int $durationMs): static
    {
        $this->durationMs = $durationMs;
        return $this;
    }

    public function getIpAnonymized(): ?string
    {
        return $this->ipAnonymized;
    }

    public function setIpAnonymized(?string $ipAnonymized): static
    {
        $this->ipAnonymized = $ipAnonymized;
        return $this;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }
}