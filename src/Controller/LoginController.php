<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Traits\RedisClusterProxy;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LoginController extends AbstractController
{
    /**
     * @var EntityManager
     */
    private $em;


    /**
     * LoginController constructor.
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @\Symfony\Component\Routing\Annotation\Route("/inscription", name="inscription")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function new (Request $request, UserPasswordEncoderInterface $encoder)   {

        $user = new User();
        $formUser = $this->createForm(UserType::class, $user);
        $formUser->handleRequest($request);


        if ($formUser->isSubmitted() && $formUser->isValid()) {

            $plainPassword = $user->getPassword();
            $encoded = $encoder->encodePassword($user, $plainPassword);
            $user->setPassword($encoded);

            $this->em->persist($user);
            $this->em->flush();
            return $this->redirectToRoute('app_login');

        }
        return $this->render('security/inscription.html.twig', [
            'user' => $user,
            'form' => $formUser->createView()
        ]);


    }

    /**
     * @Route("/login", name="app_login")
     * @param AuthenticationUtils $authenticationUtils
     * @param UserRepository $userRepository
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils, UserRepository $userRepository)
    {


//        $user = $userRepository->findAll();
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
//            'user'=>$user
        ]);
    }


    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \Exception('This method can be blank - it will be intercepted by the logout key on your firewall');
    }

    /**
     * @Route("/profil", name="profil")
     * @param UserRepository $userRepository
     * @return Response
     */
    public function profile(UserRepository $userRepository)
    {
        $user = new User();

        return $this->render('security/profile.html.twig', [
            'users'=>$user
        ]);
    }
    public function forgottenPassword(): Response
    {

        return $this->render('security/forgotten_password.html.twig');
    }

}
