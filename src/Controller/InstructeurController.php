<?php


namespace App\Controller;



use App\Entity\Lesson;
use App\Entity\Person;
use App\Entity\Training;
use App\Form\Lesson1Type;
use App\Form\LessonType;
use App\Form\RegistrationType;
use App\Form\TrainingType;
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

    /**
     * @Route("/{id}", name="lessonDelete", methods={"DELETE"})
     */
    public function delete(Request $request, Lesson $lesson): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lesson->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($lesson);
            $entityManager->flush();
        }

        return $this->redirectToRoute('agenda');
    }

    /**
     * @Route("/{id}", name="lessonShow", methods={"GET"})
     */
    public function show(Lesson $lesson): Response
    {
        return $this->render('medewerker/lessonShow.html.twig', [
            'lesson' => $lesson,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="lessonEdit", methods={"GET","POST"})
     */
    public function lessonEdit(Request $request, Lesson $lesson): Response
    {
        $form = $this->createForm(Lesson1Type::class, $lesson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('training_index');
        }

        return $this->render('medewerker/lessonEdit.html.twig', [
            'lesson' => $lesson,
            'form' => $form->createView(),
        ]);
    }

}

