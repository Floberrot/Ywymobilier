<?php

namespace App\Controller;

use App\Repository\PropertyRepository;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\DocBlock\Tags\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;


class OfferController extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $repository;
    /**
     * @var \Doctrine\Common\Persistence\ObjectManager
     */


    public function __construct(PropertyRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @Route ("/offres",name="Offres")
     * @param PropertyRepository $repository
     * @return Response
     */
    public function index(PropertyRepository $repository): Response
    {
        $properties = $repository->findLatest();
        return $this->render('/pages/offres.html.twig', [
            'properties' => $properties,
        ]);
    }

//    /**
//     * @Route ("/offres",name="Offres")
//     */
//    public function index()
//    {
//        return $this->render('/pages/offres.html.twig', [
//            'current_menu' => 'properties',
//        ]);
//    }

    /**
     * @Route ("/offres/{slug}.{id}",name="property.show", requirements={"slug": "[a-z0-9/-]*"})
     * @param \App\Entity\Property $property
     * @param string $slug
     * @return Response
     */
    public function show(\App\Entity\Property $property, string $slug):Response
    {
        if ($property->getSlug() !== $slug) {
           return $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ],301);
        }
        return $this->render('/pages/show.html.twig', [
            'property' => $property,
            'current_menu' => 'properties',
        ]);
    }


}