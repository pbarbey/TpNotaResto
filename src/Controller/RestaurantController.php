<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Form\RestaurantType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    /**
     * @Route("/add/restaurant", name="add_restaurant")
     */
    public function index(Request $request): Response
    {
        $this->denyAccessUnlessGranted("ROLE_RESTAURATEUR");

        $restaurant = new Restaurant();
        $form = $this->createForm(RestaurantType::class, $restaurant);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Restaurant $data */
            $data = $form->getData();

            $this->em->persist($data);
            $this->em->flush();
            $this->addFlash('success', 'Le restaurant a été ajouter');
            return $this->redirectToRoute('add_restaurant');
        }

        return $this->render('restaurant/index.html.twig', [
            'controller_name' => 'RestaurantController',
            'form' => $form->createView()
        ]);
    }
}
