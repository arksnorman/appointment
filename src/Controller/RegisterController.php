<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\SingupType;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RegisterController extends Controller
{
    /**
     * @Route("/register/client/", name="register_client")
     */
    public function index(Request $request)
    {
        $user = new User();
        $form = $this->createForm(SingupType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user->setRoles('ROLE_USER');
            $user->setDateCreated();
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'User created successfully');
            return $this->redirectToRoute('login');
        }

        return $this->render('register/index.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/register/staff/", name="register_staff")
     */
    public function staffRegister(Request $request)
    {
        $user = new User();
        $form = $this->createForm(SingupType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user->setRoles('ROLE_STAFF');
            $user->setDateCreated();
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'User created successfully');
            return $this->redirectToRoute('login');
        }

        return $this->render('register/index.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
