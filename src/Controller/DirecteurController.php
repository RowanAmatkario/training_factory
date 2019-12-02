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

        return $this->render('medewerker/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}