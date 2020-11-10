<?php

namespace App\Controller;

use App\Entity\Pin;
use Doctrine\ORM\EntityManager;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PinsController extends AbstractController
{
    /**
     * @Route("/pins", name="pins")
     */
    public function index(EntityManager $em): Response
    {
        $repo = $em->getRepository(Pin::class);
        $pins = $repo->findAll();

        return $this->render('pins/index.html.twig', [
            'pins' => $pins,
        ]);
    }

    public function __invoke()
    {
        // TODO: Implement __invoke() method.
        return $this->render('pins/index.html.twig');
    }

}
