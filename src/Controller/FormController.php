<?php

namespace App\Controller;

use App\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Registration;

class FormController extends AbstractController
{
    /**
     * @Route("/form", name="form")
     */
    public function index()
    {
        $post = new Post();
        $form = $this->createForm(PostType::class, $post);
        return $this->render('bezoeker/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
