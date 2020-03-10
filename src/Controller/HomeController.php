<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    /**
     * @Route ("/",name="Home")
     * @param PropertyRepository $repository
     * @param UserRepository $userRepository
     * @return Response
     */
    public function index(PropertyRepository $repository, UserRepository $userRepository): Response
    {
        $properties = $repository->findLatest();
        $user = $userRepository->findAll();

        return $this->render('/pages/home.html.twig', [
            'properties' => $properties,
            'user' => $user,
        ]);
    }

}