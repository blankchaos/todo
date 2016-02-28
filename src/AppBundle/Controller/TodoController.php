<?php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class TodoController
{
    /*
     * @Route("/test")
     */
    public function showAction()
    {
        return new Response("hi");
    }
}