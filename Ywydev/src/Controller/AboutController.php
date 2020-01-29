<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AboutController extends AbstractController
{
    /**
     * @Route("/about", name="about")
     */
    public function index(UserRepository $userRepository)
    {

        $user = $userRepository->findAll();
        return $this->render('pages/about.html.twig', [
            'controller_name' => 'AboutController',
            'user'=>$user
        ]);
    }
}
