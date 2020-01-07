<?php


namespace App\Controller;



use App\Entity\Lesson;
use App\Entity\Person;
use App\Form\LessonType;
use App\Form\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @Route("/instructeur")
 */

class InstructeurController extends AbstractController
{
    /**
     * @Route("/planlessen", name="planlessen")
     */
    public function new(Request $request)
    {
        $lesson = new Lesson();
        $form = $this->createForm(LessonType::class, $lesson);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('task_success');
        }


        return $this->render('medewerker/planLes.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/lesBeheer", name="lesBeheer")
     */
    public function lesBeheerAction()
    {
        $lid = $this->getDoctrine()->getRepository(Lesson::class)->findAll();
        return $this->render('medewerker/lesBeheer.html.twig', [
            'lid' => $lid,
        ]);
    }

}

