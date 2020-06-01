<?php

namespace App\Controller;

use App\Repository\PinRepository;
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
       dd($repo);
        return $this->render('pins/index.html.twig',compact('pins'));
    }
}
