<?php


namespace App\Controller;


use App\Entity\Training;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */

class DeelnemerController extends AbstractController
{
    /**
     * @Route("/training/{id}", name="agenda")
     */
    public function agendaAction($id)
    {
        $training = $this->getDoctrine()->getRepository(Training::class)->find($id);
        return $this->render('bezoeker/agenda.html.twig', [
            'training' => $training,
        ]);
    }

    /**
     * @Route("/activiteiten", name="kartactiviteiten")
     */
    public function kartactiviteitenAction()
    {
        $posts = $this->getDoctrine()->getRepository(Training::class)->findAll();
        return $this->render('bezoeker/kartactiviteiten.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/activiteiten", name="task_success")
     */

    public function succesAction(){
        return $this->render('bezoeker/kartactiviteiten.html.twig');
    }


}