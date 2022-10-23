<?php

namespace App\Controller;

use App\Entity\QuestionCategory;
use App\Form\QuestionCategoryFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionCategoryDBController extends AbstractController
{
    private \App\Repository\QuestionCategoryRepository|\Doctrine\ORM\EntityRepository $questionCategoryRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
        $this->questionCategoryRepository = $entityManager->getRepository(QuestionCategory::class);
    }

    #[Route('question-database/question-categories', name: 'question-categories')]
    public function index(): Response
    {
        $allCategories = $this->questionCategoryRepository->findAll();

        return $this->render('question_category_db/index.html.twig', [
            'controller_name' => 'QuestionCategoryDBController',
            'all_categories' => $allCategories
        ]);
    }

    #[Route('/question-database/question-categories/add-question-category', name: 'add-question-category')]
    public function addCompetition(Request $request): Response
    {
        $questionCategory = new QuestionCategory();
        $questionCategoryForm = $this->createForm(QuestionCategoryFormType::class, $questionCategory);

        $questionCategoryForm->handleRequest($request);
        if($questionCategoryForm->isSubmitted() && $questionCategoryForm->isValid()) {
            $newQuestionCategory = $questionCategoryForm->getData();
            $this->entityManager->persist($newQuestionCategory);
            $this->entityManager->flush();

            return $this->redirectToRoute('question-categories');
        }

        return $this->render('question_category_db/add_question_category.html.twig', [
            'controller_name' => 'QuestionCategoryDBController',
            'form' => $questionCategoryForm->createView()
        ]);
    }

    #[Route('/question-database/question-categories/edit-question-category/{id}', name: 'edit-question-category')]
    public function editCompetition($id, Request $request): Response
    {
        $questionCategory = $this->questionCategoryRepository->find($id);
        $questionCategoryForm = $this->createForm(QuestionCategoryFormType::class, $questionCategory);
        $questionCategoryForm->handleRequest($request);

        if ($questionCategoryForm->isSubmitted() && $questionCategoryForm->isValid()) {
            $questionCategory->setName($questionCategoryForm->get('name')->getData());
            $questionCategory->setCode($questionCategoryForm->get('code')->getData());

            $this->entityManager->persist($questionCategory);
            $this->entityManager->flush();

            return $this->redirectToRoute('question-categories');
        }

        return $this->render('question_category_db/edit_question_category.html.twig', [
            'controller_name' => 'QuestionCategoryDBController',
            'form' => $questionCategoryForm->createView()
        ]);
    }

}
