<?php

namespace App\EventListener;


use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Logout\LogoutHandlerInterface;

class LogoutRequestListener implements LogoutHandlerInterface
{
    private $flashBag;
    private $entityManager;

    public function __construct(FlashBagInterface $flashBag, EntityManagerInterface $entityManager)
    {
        $this->flashBag = $flashBag;
        $this->entityManager = $entityManager;
    }

    public function logout(Request $request, Response $response, TokenInterface $token) :void
    {
        $this->flashBag->set('success', 'You have been successfully logged out');

        /* @var $user User */
        $user = $token->getUser();
        $user->setLastLogin();
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
