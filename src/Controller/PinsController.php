<?php

namespace App\Controller;

use App\Entity\Pin;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PinsController extends AbstractController
{
    /**
     * @Route("/", name="pins")
     */
    public function index(): Response
    {
        $pin = new Pin;
        $pin->setTitle('Title 1');
        $pin->setDescription('Description 1');

        $em = $this->getDoctrine()->getManager();
        $em->persist($pin);
        $em->flush();
        return $this->render('pins/index.html.twig');
    }
}
