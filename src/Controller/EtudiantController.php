<?php

namespace App\Controller;

use Psr\Container\ContainerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Etudiant;

class EtudiantController extends AbstractController
{
    private $manager;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->manager = $this->getDoctrine()->getManager();
    }

    /**
     * @Route("/etudiant/list", name="etudiant.list")
     */
    public function list(): Response
    {
        $etudiants = $this->manager->getRepository(Etudiant::class)->findAll();

        return $this->render('etudiant/list.html.twig', [
            'etudiants' => $etudiants,
        ]);
    }
}
