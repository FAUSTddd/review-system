# Event-Driven Architecture Demo

Демо-проект: event-driven архитектура на Symfony Messenger + RabbitMQ + Docker.

Три независимых сервиса общаются через события. Один сервис публикует событие, два других — подписаны на него и каждый делает свою работу. Сервисы не знают друг о друге.

## Архитектура

[curl] → [review-service] → [MySQL: review_db]
↓
dispatch(ReviewCreatedEvent)
↓
[RabbitMQ: exchange review_events (fanout)]
↓
┌───────┴───────┐
↓               ↓
[catalog_service_reviews] [notification_service_reviews]
↓               ↓
[catalog-service]  [notification-service]

## Стек

- PHP 8.3
- Symfony 7.4
- Symfony Messenger (AMQP transport)
- RabbitMQ 3
- MySQL 8.0
- Docker / Docker Compose

## Запуск

    docker compose up -d --build

Проверить:

    docker compose ps

Создать схему БД:

    docker compose exec review-service php bin/console doctrine:schema:create

## Проверка

Отправить отзыв:

    curl -X POST http://localhost:8000/api/reviews \
      -H "Content-Type: application/json" \
      -d '{"productId": 42, "text": "Отличный товар!", "rating": 5}'

Проверить логи:

    docker compose logs catalog-service --tail 10
    docker compose logs notification-service --tail 10

## RabbitMQ UI

http://localhost:15672 (guest / guest)

## Что демонстрирует

- Event-driven архитектура
- Fanout exchange в RabbitMQ
- Слабая связанность сервисов
- Symfony Messenger: routing, transports, handlers
- Retry strategy + failure transport
- Docker Compose для мультисервисного окружения

## Лицензия

MIT