<?php
namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Expense;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;

class ExpenseProcessor implements ProcessorInterface
{
    public function __construct(
        private EntityManagerInterface $em,
        private Security $security,
    ) {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        if ($data instanceof Expense && $data->getUser() === null) {
            $data->setUser($this->security->getUser());
        }
        $this->em->persist($data);
        $this->em->flush();
        return $data;
    }
}
