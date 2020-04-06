<?php

namespace App\Controller\Admin;

use App\Entity\Picture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminPictureController extends AbstractController {
    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/admin/property/{id}", name="admin.picture.delete", methods="DELETE")
     * @param Picture $picture
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(Picture $picture, Request $request) {


            $em = $this->getDoctrine()->getManager();
            $em->remove($picture);
            $em->flush();
//            return new JsonResponse(['success' => 1]);
            return $this->redirectToRoute('admin.property.index');


    }
}