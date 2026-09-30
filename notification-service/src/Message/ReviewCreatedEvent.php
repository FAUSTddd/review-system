<?php

namespace App\Message;

class ReviewCreatedEvent
{
    public function __construct(
        public readonly int $reviewId,
        public readonly int $productId,
        public readonly int $rating,
    ) {}
}
