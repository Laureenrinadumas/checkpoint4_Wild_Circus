<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WildController extends AbstractController
{
    /**
     * @Route("", name="wild")
     */
    public function index()
    {
        return $this->render('wild/index.html.twig', [
            'controller_name' => 'WildController',
        ]);
    }

    public function contentInfo()
    {

    }
}
