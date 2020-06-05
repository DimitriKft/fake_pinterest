<?php

namespace App\Controller;

use App\Entity\Pin;
use App\Repository\PinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PinsController extends AbstractController
{
    /**
     * @Route("/", name="home", methods={"GET"})
     */
    public function index(PinRepository $repo): Response
    {
        $pins = $repo->findAll();
        return $this->render('pins/index.html.twig',compact('pins'));
    }

      /**
     * @Route("/pins/create", name="create", methods="GET|POST")
     */
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $pin = new Pin;
     

        $form = $this->createFormBuilder($pin)
             ->add('title', null, ['attr' => ['autofocus' => true]])
             ->add('description', null, ['attr' => ['rows' => 10, 'cols' => 50]])     
             ->add('submit', SubmitType::class, ['label' => 'Create Pin'])
             ->getForm()
        ;
      
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
           $em->persist($pin);
           $em->flush(); 

           return $this->redirectToRoute('home');
        }

        return $this->render('pins/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
