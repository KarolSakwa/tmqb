<?php

namespace App\Controller;

use App\Entity\QuestionPattern;
use App\Form\QuestionPatternFormType;
use App\Repository\QuestionPatternRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionPatternDBController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private QuestionPatternRepository|\Doctrine\ORM\EntityRepository $questionPatternRepository;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
        $this->questionPatternRepository = $entityManager->getRepository(QuestionPattern::class);
    }

    #[Route('question-database/question-patterns', name: 'question-patterns')]
    public function index(): Response
    {
        $allPatterns = $this->questionPatternRepository->findAll();

        return $this->render('question_pattern_db/index.html.twig', [
            'controller_name' => 'QuestionPatternDBController',
            'all_patterns' => $allPatterns
        ]);
    }

    #[Route('/question-database/question-patterns/add-question-pattern', name: 'add-question-pattern')]
    public function addPattern(Request $request): Response
    {
        $questionPattern = new QuestionPattern();
        $questionPatternForm = $this->createForm(QuestionPatternFormType::class, $questionPattern);

        $questionPatternForm->handleRequest($request);
        if($questionPatternForm->isSubmitted() && $questionPatternForm->isValid()) {
            $newQuestionPattern = $questionPatternForm->getData();
            $this->entityManager->persist($newQuestionPattern);
            $this->entityManager->flush();

            return $this->redirectToRoute('question-patterns');
        }

        return $this->render('question_pattern_db/add_question_pattern.html.twig', [
            'controller_name' => 'QuestionPatternDBController',
            'form' => $questionPatternForm->createView()
        ]);
    }

    #[Route('/question-database/question-patterns/edit-question-pattern', name: 'edit-question-pattern')]
    public function editPattern($id, Request $request): Response
    {
        $questionPattern = $this->questionPatternRepository->find($id);
        $questionPatternForm = $this->createForm(QuestionPatternFormType::class, $questionPattern);

        $questionPatternForm->handleRequest($request);
        if($questionPatternForm->isSubmitted() && $questionPatternForm->isValid()) {
            $questionPattern->setCategory($questionPatternForm->get('category')->getData());
            $questionPattern->setText($questionPatternForm->get('text')->getData());
            $questionPattern->setUrl($questionPatternForm->get('url')->getData());
            $questionPattern->setCode($questionPatternForm->get('code')->getData());
            $questionPattern->setFirstRecordSelector($questionPatternForm->get('first_record_selector')->getData());
            $questionPattern->setSecondRecordSelector($questionPatternForm->get('second_record_selector')->getData());
            $questionPattern->setThirdRecordSelector($questionPatternForm->get('third_record_selector')->getData());
            $questionPattern->setFourthRecordSelector($questionPatternForm->get('fourth_record_selector')->getData());
            $this->entityManager->persist($questionPattern);
            $this->entityManager->flush();

            return $this->redirectToRoute('question-patterns');
        }

        return $this->render('question_pattern_db/add_question_pattern.html.twig', [
            'controller_name' => 'QuestionPatternDBController',
            'form' => $questionPatternForm->createView()
        ]);
    }


}
