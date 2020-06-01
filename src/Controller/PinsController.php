<?php

namespace App\Controller;

use App\Entity\Pin;
use App\Repository\PinRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PinsController extends AbstractController
{
    /**
     * @Route("/", name="pins")
     */
    public function index(PinRepository $repo): Response
    {
        $pins = $repo->findAll();
        return $this->render('pins/index.html.twig',compact('pins'));
    }

      /**
     * @Route("/pins/create", name="create", methods="GET|POST")
     */
    public function create(Request $request, EntityManagerInterface $em)
    {
       if($request->isMethod('POST'))
       {
           $data = $request->request->all();

           $pin = new Pin;
           $pin->setTitle($data['title']);
           $pin->setDescription($data['description']);
           $em->persist($pin);
           $em->flush();

           dd($data);

           return $this->redirect('/');
       }
        return $this->render('pins/create.html.twig');
    }
}
