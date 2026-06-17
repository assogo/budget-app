<?php

namespace App\EventSubscriber;

use App\Entity\Expense;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ExpenseUserSubscriber implements EventSubscriberInterface
{
    public function __construct(
        private Security $security
    ) {}

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::VIEW => ['setUserToExpense', 10],
        ];
    }

    public function setUserToExpense(ViewEvent $event): void
    {
        $expense = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        // On ne traite que les créations API Platform
        if (!$expense instanceof Expense || $method !== 'POST') {
            return;
        }

        $user = $this->security->getUser();

        if ($user) {
            $expense->setUser($user);
        }
    }
}