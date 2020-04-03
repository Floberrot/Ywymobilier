<?php

namespace App\Controller\Admin;

use App\Entity\Picture;
use App\Form\PropertyType;
use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Liip\ImagineBundle\Imagine\Cache\CacheManager;
use phpDocumentor\Reflection\Types\AbstractList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Property;

class AdminPropertyController extends AbstractController
{
    /**
     * @var PropertyRepository
     */
    private $repository;
    /**
     * @var ObjectManager
     */
    private $em;

    /**
     * AdminController constructor.
     * @param PropertyRepository $repository
     * @param EntityManagerInterface $em
     */
    public function __construct(PropertyRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @\Symfony\Component\Routing\Annotation\Route("/admin", name="admin.property.index")
     * @param UserRepository $userRepository
     * @return Response
     */
    public function index(UserRepository $userRepository): Response
    {
        $properties = $this->repository->findBy([
            'user' => $userRepository->find($this->getUser()->getId())
        ]);

        return $this->render('admin/property/index.html.twig', [
            'property' => $properties
        ]);
    }


    /**
     * @\Symfony\Component\Routing\Annotation\Route("/admin/property/create", name="admin.property.new")
     * @param Request $request
     * @param UserRepository $userRepository
     * @return Response
     */
    public function new(Request $request, UserRepository $userRepository)
    {

        $property = new Property();
        $image = new Picture();
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);

        $userId = $userRepository->findOneById($this->getUser()->getId());
        $property->setUser($userId);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($property);
            $this->em->flush();
            return $this->redirectToRoute('admin.property.index');

        }
        return $this->render('/admin/property/new.html.twig', [
            'property' => $property,
            'form' => $form->createView(),
            'picture' =>$image
        ]);

    }

    /**
     * @\Symfony\Component\Routing\Annotation\Route("/admin/property/{id}", name="admin.property.edit", methods="GET|POST")
     * @param Property $property
     * @param Request $request
     * @return Response
     */
    public function edit(Property $property, Request $request )
    {
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);
        $image = new Picture();


        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Bien modifié avec succès');
            return $this->redirectToRoute('admin.property.index');

        }
        return $this->render('/admin/property/edit.html.twig', [
            'property' => $property,
            'form' => $form->createView(),
            'picture' =>$image

        ]);
    }

    /**
     * * @\Symfony\Component\Routing\Annotation\Route("/admin/property/{id}", name="admin.property.delete", methods="DELETE")
     * @param Property $property
     * @param Request $request
     * @return Response
     */
    public function delete(Property $property, Request $request)
    {

        if ($this->isCsrfTokenValid('delete' . $property->getId(), $request->get('_token'))) {
            $this->em->remove($property);
            $this->em->flush();
            $this->addFlash('success', 'Bien supprimé avec succès');

        }
        return $this->redirectToRoute('admin.property.index');
    }
}