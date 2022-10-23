<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuestionDBController extends AbstractController
{
    #[Route('/question-database', name: 'question-database')]
    public function index(): Response
    {
        return $this->render('question_db/index.html.twig', [
            'controller_name' => 'QuestionDBController',
        ]);
    }

}