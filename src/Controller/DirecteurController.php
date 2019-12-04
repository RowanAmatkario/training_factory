<?php


namespace App\Controller;


use App\Entity\Training;
use App\Form\TrainingType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DirecteurController extends AbstractController
{
    /**
     * @Route("/add", name="add")
     */
    public function new(Request $request)
    {
        $training = new Training();
        $form = $this->createForm(TrainingType::class, $training);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('task_success');
        }


        return $this->render('medewerker/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }



    /**
     * @Route("/activiteiten", name="task_success")
     */

    public function succesAction()
    {
        return $this->render('bezoeker/kartactiviteiten.html.twig');
    }

    /**
     * @Route("/edit", name="sportEdit")
     */
    public function sportEditAction()
    {
        $posts = $this->getDoctrine()->getRepository(Training::class)->findAll();
        return $this->render('medewerker/editSport.html.twig', [
            'posts' => $posts,
        ]);
    }


}