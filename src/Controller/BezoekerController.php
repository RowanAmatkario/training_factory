<?php

namespace App\Controller;


use App\Entity\Lesson;
use App\Entity\Person;
use App\Entity\Training;
use App\Form\RegistrationType;
use App\Form\TrainingType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
USE Doctrine\Common\Annotations\Annotation;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class BezoekerController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function homepageAction()
    {
        $comments = [
            'Trainingscentrum Den Haag heeft ook een praktijk in Ypenburg. Het MTC Ypenburg.Na 10 jaar gezeten te hebben in het gezondheidscentrum Ypenburg zijn we op 3 juli 2017 overgestapt naar de Laan van Hoornwijck 174. Een uitbreiding van ons centrum met oefenzaal en fitness apparatuur.
            In Ypenburg wordt er naast fysiotherapie ook Orthopedische Manuele Therapie, psychosomatische fysiotherapie, sportfysiotherapie, kinderfysiotherapie, oedeemtherapie en medische trainings therapie gegeven.
            Het team van fysiotherapeuten bestaat uit zowel vrouwelijke als mannelijke therapeuten, die al geruime tijd in het vak zitten en zich regelmatig laten bij- en nascholen. De lijst van therapeuten die werkzaam zijn in Ypenburg vindt u hier.
            Kwaliteit van zorg, overleg met (huis)artsen en multidisciplinair werken zijn zaken die het MTC Ypenburg belangrijk vindt.
            Onze therapeuten staan geregistreerd in het Centraal Kwaliteits Register voor fysiotherapie en manuele therapie.',

        ];
        $posts = $this->getDoctrine()->getRepository(Training::class)->findAll();

        return $this->render( 'bezoeker/index.html.twig', [
            'posts' => $posts,
            'comments' => $comments,
        ]);

    }



    /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {
        return $this->render('bezoeker/login.html.twig');
    }


//Form database
    /**
     * @Route("/registration", name="registration")
     */
    public function new(Request $request)
    {
        $person = new Person();
        $form = $this->createForm(RegistrationType::class, $person);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $task = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('task_success');
        }


        return $this->render('bezoeker/registeren.html.twig', [
            'form' => $form->createView(),
        ]);
    }






    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils)
    {

        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('bezoeker/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }





}




