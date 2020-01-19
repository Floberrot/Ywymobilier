<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;


class OfferController extends AbstractController
{
    /**
     * @Route ("/offres",name="Offres")
     */
    public function index()
    {
        return $this->render('/pages/offres.html.twig', [
            'current_menu' => 'OfferController',
        ]);
    }

}