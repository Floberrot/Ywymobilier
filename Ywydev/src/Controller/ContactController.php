<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @var ContactRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * AdminController constructor.
     * @param ContactRepository $repository
     * @param EntityManagerInterface $em
     */
    public function __construct(ContactRepository $repository, EntityManagerInterface $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }

    /**
     * @\Symfony\Component\Routing\Annotation\Route("/contact", name="contact")
     * @param UserRepository $userRepository
     * @return Response
     */
    public function index(UserRepository $userRepository)
    {

        $user = $userRepository->findAll();
        return $this->render('pages/contact.html.twig', [
            'controller_name' => 'ContactController',
            'user' => $user
        ]);
    }


    /**
     * @\Symfony\Component\Routing\Annotation\Route("/contact", name="contact")
     * @param Request $request
     * @param UserRepository $userRepository
     * @return Response
     */
    public function new (Request $request, UserRepository $userRepository): Response  {

        $user = $userRepository->findAll();

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($contact);
            $this->em->flush();
            $this->addFlash('success', 'Merci beaucoup pour le message! On le lira avec attention!');
            return $this->redirectToRoute('about');

        }
        return $this->render('/pages/contact.html.twig', [
            'property' => $contact,
            'form' => $form->createView(),
            'user' => $user
        ]);

    }
}