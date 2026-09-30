<?php

namespace App\MessageHandler;

use App\Message\ReviewCreatedEvent;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class UpdateRatingHandler
{
    public function __invoke(ReviewCreatedEvent $event): void
    {
        error_log(sprintf(
            '[catalog-service] Получено событие: reviewId=%d, productId=%d, rating=%d',
            $event->reviewId,
            $event->productId,
            $event->rating,
        ));
    }
}
