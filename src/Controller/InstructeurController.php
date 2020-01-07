<?php


namespace App\Controller;



use App\Entity\Lesson;
use App\Entity\Person;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function planlessenAction()
    {
        return $this->render('medewerker/planLes.html.twig');
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
