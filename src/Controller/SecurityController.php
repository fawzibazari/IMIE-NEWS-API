<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends AbstractController
{


    /**
     * @Route("/api/login", name="api_login_check", methods={"POST"})
     */
    public function login()
    {
        //$user =

        var_dump($this->getUser());
        return $this->json([
                'user' => $this->getUser() ? $this->getUser()->getId() : null]
        );
    }
}