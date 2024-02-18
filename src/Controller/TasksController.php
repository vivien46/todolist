<?php

namespace App\Controller;

use App\Entity\Tasks;
use App\Form\TaskType;
use App\Repository\TasksRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TasksController extends AbstractController
{
    #[Route('/tasks', name: 'app_tasks')]
    public function index(TasksRepository $repo): Response
    {
        $tasks = $repo->findAll();

        return $this->render('tasks/index.html.twig', [
            'tasks' => $tasks,
        ]);
    }

    #[Route('/new', name: 'app_new')]
    public function new(Request $request, EntityManagerInterface $manager): Response
    {
        $task = new Tasks;

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if($form -> isSubmitted() && $form -> isValid()){
            $manager->persist($task);
            $manager->flush();

            return $this->redirectToRoute('app_tasks');

        }

        return $this->render('tasks/new.html.twig', [
            'taskForm' => $form->createView(),
        ]);
    }
}
