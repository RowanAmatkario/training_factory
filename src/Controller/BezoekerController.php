<?php

namespace App\Controller;


use App\Entity\Lesson;
use App\Entity\Training;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
USE Doctrine\Common\Annotations\Annotation;


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
     * @Route("/training", name="agenda")
     */
    public function agendaAction()
    {
        $posts = $this->getDoctrine()->getRepository(Training::class)->findAll();
        return $this->render('bezoeker/agenda.html.twig', [
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/activiteiten", name="kartactiviteiten")
     */
    public function kartactiviteitenAction()
    {
        $posts = $this->getDoctrine()->getRepository(Training::class)->findAll();
        return $this->render('bezoeker/kartactiviteiten.html.twig', [
            'posts' => $posts,
        ]);
    }



}




