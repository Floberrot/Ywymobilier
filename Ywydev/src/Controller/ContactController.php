<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use PhpParser\Builder\Class_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{

    /**
     * @Route("contact", name="contact")
     */
    public function index()
    {
        return $this->render('pages/contact.html.twig', [
            'controller_name' => 'ContactController',
        ]);
    }

    /**
     * @var EntityManager
     */
    private $em;


    /**
     * ContactController constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function new(Request $request)
    {

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($contact);
            $this->em->flush();
            return $this->redirectToRoute('/pages/about.html.index');

        }
        return $this->render('templates/pages/about.html.index', [
            'property' => $contact,
            'form' => $form->createView()
        ]);
    }
}