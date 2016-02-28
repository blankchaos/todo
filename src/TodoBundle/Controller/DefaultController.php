<?php

namespace TodoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

use TodoBundle\Entity\Task;

class DefaultController extends Controller
{
    /**
     * @Route("/", options={"expose"=true})
     */
    public function indexAction()
    {
        $em = $this->container->get('doctrine')->getEntityManager();

        $todo = $em->getRepository('TodoBundle:Task')
            ->findBy(array(), array('priority'=>'DESC'));//find all tasks in database

        return $this->render('@Todo/Default/index.html.twig', array(
            'todo' => $todo
        ));
    }

    /**
     * @Route("/add", name="add", options={"expose"=true})
     */
    public function taskAddAction(Request $request)
    {
        $em = $this->container->get('doctrine')->getEntityManager();

        //add tasks to database block start
        $task = new Task();
        $task->setDueDate(new \DateTime($request->get('dueDate')));
        $task->setTitle($request->get('title'));
        $task->setPriority($request->get('priority'));
        $task->setContent($request->get('content'));
        $task->setAssigned($request->get('assigned'));
        $task->setIsCompleted(0);

        $em->persist($task);
        $em->flush();
        //add tasks to database block end

        return new JsonResponse(1);
    }

    /**
     * @Route("/edit", name="edit", options={"expose"=true})
     */
    public function taskEditAction(Request $request)
    {
        $task_id = $request->get('task_id');

        $em = $this->container->get('doctrine')->getEntityManager();
        $task_update = $em->getRepository('TodoBundle:Task')->findOneBy(['id' => $task_id]);//search for task with given id to edit

        $task_update->setDueDate(new \DateTime($request->get('dueDate')));
        $task_update->setTitle($request->get('title'));
        $task_update->setContent($request->get('content'));
        $task_update->setAssigned($request->get('assigned'));
        $task_update->setIsCompleted($request->get('isCompleted'));

        $em->persist($task_update);
        $em->flush();

        return new JsonResponse(1);
    }
}

