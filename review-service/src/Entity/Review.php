<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReviewRepository::class)]
class Review
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private int $productId;

    #[ORM\Column(type: 'text')]
    private string $text;

    #[ORM\Column]
    private int $rating;

    #[ORM\Column(type: 'datetime_immutable')]
    private \DateTimeImmutable $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): ?int { return $this->id; }
    public function getProductId(): int { return $this->productId; }
    public function setProductId(int $productId): self { $this->productId = $productId; return $this; }
    public function getText(): string { return $this->text; }
    public function setText(string $text): self { $this->text = $text; return $this; }
    public function getRating(): int { return $this->rating; }
    public function setRating(int $rating): self { $this->rating = $rating; return $this; }
    public function getCreatedAt(): \DateTimeImmutable { return $this->createdAt; }
}
