<?php


namespace App\Controller;


use App\Entity\Lesson;
use App\Entity\Registration;
use App\Entity\Training;
use Guzzle\Http\Message\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/user")
 */

class DeelnemerController extends AbstractController
{

    /**
     * @Route("/agenda/{id}", name="agenda")
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

    public function profielAction(){
        return $this->render('deelnemer/profiel.html.twig');
    }


    /**
     * @Route("/inschrijving/{id}", name="inschrijving")
     */
    public function inschrijvingenAction(Request $request, $lesson){

        $user = $this->getUser();
        $inschrijving = new Registration();
        $lesson = $this->getDoctrine()->getRepository(Lesson::class)->findAll();

        $inschrijving->setRegistration($lesson);
        $inschrijving->setUser($user);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($inschrijving);
        $entityManager->flush();

        return $this->redirectToRoute('agenda');


    }


}