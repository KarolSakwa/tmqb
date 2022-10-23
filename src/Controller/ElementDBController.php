<?php

namespace App\Controller;

use App\Entity\Competition;
use App\Form\CompetitionFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ElementDBController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private \App\Repository\CompetitionRepository|\Doctrine\ORM\EntityRepository $competitionRepository;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
        $this->competitionRepository = $this->entityManager->getRepository(Competition::class);
    }

    #[Route('/element-database', name: 'element-database')]
    public function index(): Response
    {
        $allCompetitions = $this->competitionRepository->findAll();

        return $this->render('element_db/index.html.twig', [
            'controller_name' => 'ElementDBController',
            'all_competitions' => $allCompetitions
        ]);
    }

    #[Route('/element-database/add-competition', name: 'add-competition')]
    public function addCompetition(Request $request): Response
    {
        $competition = new Competition();
        $competitionForm = $this->createForm(CompetitionFormType::class, $competition);

        $competitionForm->handleRequest($request);
        if($competitionForm->isSubmitted() && $competitionForm->isValid()) {
            $newCompetition = $competitionForm->getData();
            $this->entityManager->persist($newCompetition);
            $this->entityManager->flush();

            return $this->redirectToRoute('element-database');
        }

        return $this->render('element_db/add_element.html.twig', [
            'controller_name' => 'ElementDBController',
            'form' => $competitionForm->createView(),
            'element_name' => 'competition'
        ]);
    }

    #[Route('/element-database/edit-competition/{id}', name: 'edit-competition')]
    public function editCompetition($id, Request $request): Response
    {
        $competition = $this->competitionRepository->find($id);
        $competitionForm = $this->createForm(CompetitionFormType::class, $competition);
        $competitionForm->handleRequest($request);

        if($competitionForm->isSubmitted() && $competitionForm->isValid()) {
            $competition->setName($competitionForm->get('name')->getData());
            $competition->setCode($competitionForm->get('code')->getData());
            $competition->setLogo($competitionForm->get('logo')->getData());
            $competition->setReputation($competitionForm->get('reputation')->getData());

            $this->entityManager->persist($competition);
            $this->entityManager->flush();

            return $this->redirectToRoute('element-database');
        }

        return $this->render('element_db/edit_element.html.twig', [
            'controller_name' => 'ElementDBController',
            'form' => $competitionForm->createView(),
            'element_name' => 'competition'
        ]);
    }
}
