<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class BlogController extends AbstractController
{
    //The home route where all of the posts are Returned
    
    /**
     * @Route("/", name="blog")
     */
    public function index(): Response{
        $posts = $this->getDoctrine()->getRepository(Post::class)->findAll();
        return $this->render('blog/index.html.twig',[
            'posts' => $posts
        ]);
    }

    //The create a new post route

    /**
     * @Route("/create_post", name="create")
     */
    public function create(Request $request){
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();

            $this->addFlash('notice','Post Submited Successfully!');

            return $this->redirectToRoute('blog');
        }

        return $this->render('blog/create_post.html.twig',[
            'form' => $form->createView()
        ]);
    }

    //The update a post route

    /**
     * @Route("/update_post/{id}", name="update")
     */
    public function update(Request $request, $id){
        $post = $this->getDoctrine()->getRepository(Post::class)->find($id);
        $form = $this->createForm(PostType::class, $post);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($post);
            $entityManager->flush();

            $this->addFlash('notice','Post Updated Successfully!');

            return $this->redirectToRoute('blog');
        }

        return $this->render('blog/update_post.html.twig',[
            'form' => $form->createView()
        ]);
    }

    //The delete a post route

    /**
     * @Route("/delete_post/{id}", name="delete")
     */
    public function delete($id){
        $post = $this->getDoctrine()->getRepository(Post::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($post);
        $entityManager->flush();

        $this->addFlash('notice','Post Deleted Successfully!');

        return $this->redirectToRoute('blog');
    }
}
