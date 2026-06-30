<?php
namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Expense;
use Symfony\Bundle\SecurityBundle\Security;

class ExpenseProcessor implements ProcessorInterface
{
    public function __construct(
        private ProcessorInterface $persistProcessor,
        private Security $security,
    ) {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        if ($data instanceof Expense && $data->getUser() === null) {
            $data->setUser($this->security->getUser());
        }
        return $this->persistProcessor->process($data, $operation, $uriVariables, $context);
    }
}
