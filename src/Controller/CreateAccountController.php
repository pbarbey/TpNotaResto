<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class CreateAccountController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    /**
     * @Route("/createAccount", name="create_account")
     */
    public function index(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var User $data */
            $data = $form->getData();

            /* Lorsqu'on enregistre un utilisateur avec le ROLE_USER
             la propriété roles de l'objet est vide.
             Pas de problème avec le ROLE_RESTAURATEUR
            */
            $data->setRoles($data->getRoles()); //bug symfony ?

            $hashedPassword = $passwordHasher->hashPassword(
                $data,
                $data->getPassword()
            );
            $data->setPassword($hashedPassword);

            $this->em->persist($data);
            $this->em->flush();
            $this->addFlash('success', 'Votre compte a été créer');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('create_account/index.html.twig', [
            'controller_name' => 'CreateAccountController',
            'form' => $form->createView()
        ]);
    }
}
