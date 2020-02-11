<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\PropertyRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ObjectManager;
use phpDocumentor\Reflection\DocBlock\Tags\Property;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

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
    public function index(PropertyRepository $repository, UserRepository $userRepository): Response
    {

        $user = $userRepository->findAll();
        $properties = $repository->findLatest();
        return $this->render('/pages/offres.html.twig', [
            'properties' => $properties,
            'user' =>$user
        ]);

    }

    /**
     * @Route ("/offres/get",name="getOffer")
     * @param PropertyRepository $repository
     * @return Response
     */
    public function getOffer(PropertyRepository $repository): Response
    {
        $properties = $repository->findLatest();
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());

        $serializer = new Serializer($normalizers, $encoders);
        $productSerialized = $serializer->serialize($properties, 'json');

       return new Response($productSerialized, Response::HTTP_OK, ['Content-Type' => 'application/json']);

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
    public function show(\App\Entity\Property $property, string $slug): Response
    {
        if ($property->getSlug() !== $slug) {
            return $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug' => $property->getSlug()
            ], 301);
        }
        return $this->render('/pages/show.html.twig', [
            'property' => $property,
            'current_menu' => 'properties',
            'user'=> User::class
        ]);
    }


}