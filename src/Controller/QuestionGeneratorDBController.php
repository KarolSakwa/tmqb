<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\QuestionCategory;
use App\Entity\QuestionPattern;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionGeneratorDBController extends AbstractController
{
    private EntityManagerInterface $entityManager;
    private \Doctrine\ORM\EntityRepository|\App\Repository\QuestionRepository $questionsRepository;
    private \App\Repository\QuestionPatternRepository|\Doctrine\ORM\EntityRepository $questionPatternsRepository;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
        $this->questionsRepository = $this->entityManager->getRepository(Question::class);
        $this->questionPatternsRepository = $this->entityManager->getRepository(QuestionPattern::class);
    }

    #[Route('/questions', name: 'questions')]
    public function index(): Response
    {
        $allQuestions = $this->questionsRepository->findAll();
        $allQuestionPatterns = $this->questionPatternsRepository->findAll();

        return $this->render('question_generator_db/index.html.twig', [
            'controller_name' => 'QuestionGeneratorDBController',
            'all_questions' => $allQuestions,
            'all_question_patterns' => $allQuestionPatterns
        ]);
    }
}
