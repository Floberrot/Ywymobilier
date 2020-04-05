<?php

namespace App\Controller;

use App\Repository\PictureRepository;
use App\Repository\PropertyRepository;
use App\Repository\UserRepository;
use phpDocumentor\Reflection\Types\This;
use Proxies\__CG__\App\Entity\Picture;
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
     * @param PictureRepository $pictureRepository
     * @return Response
     */
    public function index(PropertyRepository $repository, UserRepository $userRepository, PictureRepository $pictureRepository): Response
    {
        $properties = $repository->findLatest();
        $picture = $pictureRepository->findOneById(1);
        $user = $userRepository->findAll();

        return $this->render('/pages/home.html.twig', [
            'properties' => $properties,
            'user' => $user,
            'picture' => $picture
        ]);
    }

}