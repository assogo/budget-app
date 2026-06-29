<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController
{
    #[Route('/', name: 'home', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return new JsonResponse([
            'app' => 'Budget App API',
            'status' => 'online',
            'version' => '1.0.0',
            'docs' => '/api/docs',
            'endpoints' => [
                'expenses' => '/api/expenses',
                'login' => '/api/login_check',
                'register' => '/api/register'
            ]
        ]);
    }
}