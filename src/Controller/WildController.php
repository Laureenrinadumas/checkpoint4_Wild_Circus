<?php

namespace App\Controller;


use App\Entity\Content;
use App\Repository\ContentRepository;
use App\Repository\PerformanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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

    /**
     * @Route("/info", name="wild_info", methods={"GET"})
     * @param ContentRepository $contentRepository
     * @return Response
     */
    public function showContent(ContentRepository $contentRepository)
    {

        return $this->render('wild/content_info.html.twig', [
            'contents' => $contentRepository->findAll(),

        ]);
    }

    /**
     * @Route("/performs", name="wild_performs", methods={"GET"})
     * @param PerformanceRepository $performanceRepository
     * @return Response
     */
    public function showPerformance(PerformanceRepository $performanceRepository)
    {
        return $this->render('wild/performance_info.html.twig', [
            'performances' => $performanceRepository->findAll()
        ]);
    }

    /**
     * @Route("/profile", name="wild_profile")
     * @return Response
     */
    public function profile()
    {
        return $this->render('wild/my_profile.html.twig');
    }

}
