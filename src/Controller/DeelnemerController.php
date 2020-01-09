<?php


namespace App\Controller;


use App\Entity\Lesson;
use App\Entity\Registration;
use App\Entity\Training;
use App\Entity\User;
use App\Form\LessonType;
use App\Form\ProfielType;
use Guzzle\Http\Message\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Flex\Response;

/**
 * @Route("/user")
 */

class DeelnemerController extends AbstractController
{

    /**
     * @Route("/agenda", name="agenda")
     */
    public function agendaAction()
    {
        $training = $this->getDoctrine()->getRepository(Training::class)->findAll();
        return $this->render('bezoeker/agenda.html.twig', [
            'training' => $training,
        ]);
    }

    /**
     * @Route("/activiteiten", name="kartactiviteiten")
     */
    public function kartactiviteitenAction()
    {
        $trainingen = $this->getDoctrine()->getRepository(Training::class)->findAll();
        return $this->render('bezoeker/kartactiviteiten.html.twig', [
            'trainingen' => $trainingen,
        ]);
    }

    /**
     * @Route("/activiteiten", name="task_success")
     */

    public function succesAction(){
        return $this->render('bezoeker/kartactiviteiten.html.twig');
    }




    /**
     * @Route("/profiel", name="profiel")
     */
    public function edit(Request $request, User $user): \Symfony\Component\HttpFoundation\Response
    {
        $form = $this->createForm(ProfielType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('task_success');
        }


        return $this->render('deelnemer/profiel.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }





    /**
     * @Route("/inschrijving/{id}", name="inschrijving")
     */
    public function inschrijvingenAction($id){

        $user = $this->getUser();
        $inschrijving = new Registration();
        $lesson = $this->getDoctrine()->getRepository(Lesson::class)->find($id);


        $inschrijving->setRegistration($lesson);
        $inschrijving->setUser($user);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($inschrijving);
        $entityManager->flush();


        return $this->redirectToRoute('homepage');

    }


}