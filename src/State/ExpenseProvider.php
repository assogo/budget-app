<?php
namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Repository\ExpenseRepository;
use Symfony\Bundle\SecurityBundle\Security;

class ExpenseProvider implements ProviderInterface
{
    public function __construct(
        private ExpenseRepository $repository,
        private Security $security,
    ) {}

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array
    {
        $user = $this->security->getUser();
        if (!$user) return [];
        return $this->repository->findBy(['user' => $user]);
    }
}
