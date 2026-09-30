<?php

namespace App\Service;

use App\Entity\Review;
use App\Message\ReviewCreatedEvent;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\MessageBusInterface;

class ReviewService
{
    public function __construct(
        private EntityManagerInterface $em,
        private MessageBusInterface $bus,
    ) {}

    public function create(int $productId, string $text, int $rating): Review
    {
        $review = new Review();
        $review->setProductId($productId);
        $review->setText($text);
        $review->setRating($rating);

        $this->em->persist($review);
        $this->em->flush();

        $this->bus->dispatch(new ReviewCreatedEvent(
            reviewId: $review->getId(),
            productId: $productId,
            rating: $rating,
        ));

        return $review;
    }
}
