<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends AbstractController
{
    #[Route('/taskform', name: 'app_task_form')]
    public function new(Request $request): Response
    {
        $task = new Task();


        $form = $this->createForm(TaskType::class, $task);

        return $this->renderForm('task/new.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/task', name: 'app_task')]
    public function index(): Response
    {
        return $this->render('task/index.html.twig', [
            'controller_name' => 'TaskController',
        ]);

    }
}
