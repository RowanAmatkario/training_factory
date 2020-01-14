<?php


namespace App\Controller;


use App\Entity\Lesson;
use App\Entity\Registration;
use App\Entity\Training;
use App\Entity\User;
use App\Form\LessonType;
use App\Form\ProfielType;
use App\Form\RegistrationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

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
     * @Route("/profielEdit", name="profieledit", methods={"GET","POST"})
     */
   public function profileEditAction(Request $request):Response
   {
       $user = $this->getUser();
       $form = $this->createForm(ProfielType::class, $user);
       $form->handleRequest($request);

       if ($form->isSubmitted()&& $form->isValid()) {
           $user = $form->getData();
           $entitymanager = $this->getDoctrine()->getManager();
           $entitymanager->persist($user);
           $entitymanager->flush();
       }
       return $this->render('deelnemer/profiel.html.twig', [
           'user' => $user,
           'form' => $form->createView()
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


        return $this->redirectToRoute('overzichtInschrijvingen');

    }

    /**
     * @Route("/overzichtInschrijvingen/{id}", name="inschrijvingDelete", methods={"DELETE"})
     */
    public function inschrijvingDelete(Request $request, Registration $registration): Response
    {
        if ($this->isCsrfTokenValid('delete'.$registration->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($registration);
            $entityManager->flush();
        }

        return $this->redirectToRoute('overzichtInschrijvingen');
    }

    /**
     * @Route("/overzichtInschrijvingen", name="overzichtInschrijvingen")
     */

    public function overzichtInschrijvingenAction(){

        $user = $this->getUser();
        $registrations = $user->getRegistrations();

        return $this->render('deelnemer/overzichtInschrijvingen.html.twig', [
            'registrations' => $registrations,
        ]);
    }


}