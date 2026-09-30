<?php

namespace App\MessageHandler;

use App\Message\ReviewCreatedEvent;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class SendNotificationHandler
{
    public function __invoke(ReviewCreatedEvent $event): void
    {
        error_log(sprintf(
            '[notification-service] Отправка уведомления о новом отзыве: reviewId=%d',
            $event->reviewId,
        ));
    }
}
