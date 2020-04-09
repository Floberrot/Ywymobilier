<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiController extends AbstractController
{
    /**
     * @Route("/api", name="api")
     * @return Response
     */
    public function index()
    {

        return $this->render('pages/api.php', [
            'controller_name' => 'ApiController',
        ]);
    }
}
