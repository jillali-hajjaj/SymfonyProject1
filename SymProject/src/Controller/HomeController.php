<?php

namespace App\Controller;

use App\Entity\Clients;
use App\Form\ClientsType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="root")
     * @Route("/home", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/home.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/home/new", name="client_create")
     * @Route("/home/edit/{id}", name="client_edit")
     * @IsGranted("ROLE_USER")
     */
    public function create(Clients $client = null, Request $request, EntityManagerInterface $manager): Response
    {
        if(!$client){
            $client = new Clients();
        }
        $form = $this->createForm(ClientsType::class,$client);
        $form->handleRequest($request);
        if($form->isSubmitted()&&$form->isValid()){
            $manager->persist($client);
            $manager->flush();

            return $this->redirectToRoute('show');
        }
        return $this->render('home/create.html.twig', [
            'formClient' => $form->createView(),
            'editMode' => $editmode = $client->getId()!=null
        ]);
    }

    /**
     * @Route("/show", name="show")
     * @IsGranted("ROLE_USER")
     */
    public function show(): Response
    {
        $repo = $this->getDoctrine()->getRepository(Clients::class);
        $clients =  $repo->findAll();

        return $this->render('home/showClients.html.twig', [
            'clients' => $clients,
        ]);
    }




}
