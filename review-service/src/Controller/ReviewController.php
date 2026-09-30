<?php

namespace App\Controller;

use App\Service\ReviewService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class ReviewController
{
    public function __construct(private ReviewService $reviewService) {}

    #[Route('/api/reviews', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $review = $this->reviewService->create(
            productId: $data['productId'],
            text: $data['text'],
            rating: $data['rating'],
        );

        return new JsonResponse([
            'id' => $review->getId(),
            'status' => 'created',
        ], 201);
    }
}
