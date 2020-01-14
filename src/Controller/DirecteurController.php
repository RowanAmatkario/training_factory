<?php


namespace App\Controller;


use App\Entity\Person;
use App\Entity\Training;
use App\Entity\User;
use App\Form\InstructorType;
use App\Form\ProfielType;
use App\Form\TrainingType;
use App\Form\UserType;
use App\Repository\TrainingRepository;
use App\Repository\UserRepository;
use Doctrine\DBAL\Types\TextType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
    * @Route("/admin")
    */
    

class DirecteurController extends AbstractController
{


    /**
     * @Route("/training", name="training_index", methods={"GET"})
     */
    public function index(TrainingRepository $trainingRepository): Response
    {
        return $this->render('medewerker/editSport.html.twig', [
            'trainings' => $trainingRepository->findAll(),
        ]);
    }

    /**
 * @Route("/training/add", name="training_new", methods={"GET","POST"})
 */
    public function new(Request $request):Response
    {
        $training = new Training();
        $form = $this->createForm(TrainingType::class, $training);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {


            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($training);
            $entityManager->flush();

            return $this->redirectToRoute('training_index');
        }


        return $this->render('medewerker/add.html.twig', [
            'training' => $training,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/training/{id}", name="training_show", methods={"GET"})
     */
    public function show(Training $training): Response
    {
        return $this->render('medewerker/show.html.twig', [
            'training' => $training,
        ]);
    }

    /**
     * @Route("/training/{id}/edit", name="training_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Training $training): Response
    {
        $form = $this->createForm(TrainingType::class, $training);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('training_index');
        }

        return $this->render('medewerker/modifySport.html.twig', [
            'training' => $training,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/training/{id}", name="training_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Training $training): Response
    {
        if ($this->isCsrfTokenValid('delete'.$training->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($training);
            $entityManager->flush();
        }

        return $this->redirectToRoute('training_index');
    }

    public function adminDashboard()
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
    }

    /**
     * @Route("/leden", name="leden")
     */

    public function ledenAction(){
        $lid = $this->getDoctrine()->getRepository(User::class)->findByRole("ROLE_USER");
        return $this->render('deelnemer/leden.html.twig', [
            'lid' => $lid,
        ]);
    }

    /**
     * @Route("/leden/{id}/editLeden", name="editLeden", methods={"GET","POST"})
     */
    public function ledenEdit(Request $request, User $lid): Response
    {
        $form = $this->createForm(ProfielType::class, $lid);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('training_index');
        }

        return $this->render('medewerker/ledenEdit.html.twig', [
            'lid' => $lid,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/leden/{id}", name="ledenDelete", methods={"DELETE"})
     */
    public function ledenDelete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('leden');
    }

    /**
     * @Route("/newInstructor", name="newInstructor")
     */
    public function newInstructor(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $instructor = new User();
        $form = $this->createForm(InstructorType::class, $instructor);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();
            $task->setRoles(['ROLE_INSTRUCTOR']);
            $task->setPassword($passwordEncoder->encodePassword($task, $task->getPassword()));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('viewInstructor');
        }


        return $this->render('medewerker/addInstructor.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/viewInstructor", name="viewInstructor", methods={"GET"})
     */
    public function allIntructor(UserRepository $userRepository): Response
    {
        return $this->render('medewerker/viewInstructor.html.twig', [
            'user' => $userRepository->findByRole("ROLE_INSTRUCTOR"),
        ]);
    }

    /**
     * @Route("/viewInstructor/{id}", name="instructorDelete", methods={"DELETE"})
     */
    public function instructorDelete(Request $request, User $user): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('viewInstructor');
    }





}