<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    /**
     * @Route("/about", name="about")
     */
    public function index()
    {
        return $this->render('pages/about.html.twig', [
            'controller_name' => 'AboutController',
        ]);
    }
}
