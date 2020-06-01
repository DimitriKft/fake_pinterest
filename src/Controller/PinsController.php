<?php

namespace App\Controller;

use App\Entity\Pin;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PinsController extends AbstractController
{
    /**
     * @Route("/", name="pins")
     */
    public function index(EntityManagerInterface $em): Response
    {
        $repo = $em->getRepository(Pin::class);

        $pins = $repo->findAll();
        return $this->render('pins/index.html.twig', [
            "pins" => $pins
        ]);
    }
}
