<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\PostFormType;
use App\Entity\Post;


class BlogController extends AbstractController
{
    /**
     * @Route("/", name="blog")
     */
    public function index(): Response
    {
        return $this->render('base.html.twig',[
            'controller_name' => 'BlogController',
        ]);
    }
}
