<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    /**
     * @Route ("/",name="Home")
     */
    public function index()
    {
        return $this->render('/pages/home.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

}