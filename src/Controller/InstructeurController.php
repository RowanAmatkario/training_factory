<?php


namespace App\Controller;



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

}
