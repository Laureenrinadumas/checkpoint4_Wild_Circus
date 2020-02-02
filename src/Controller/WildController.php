<?php

namespace App\Controller;


use App\Entity\Content;
use App\Repository\ContentRepository;
use App\Repository\PerformanceRepository;
use App\Repository\PriceRepository;
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
        return $this->render('home.html.twig');
    }

    /**
     * @Route("/homepage", name="show_homepage")
     * @return Response
     */
    public function showHomepage()
    {
        return $this->render('wild/homepage.html.twig');
    }

    /**
     * @Route("/contents", name="show_content", methods={"GET"})
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
     * @Route("/performs", name="show_performs", methods={"GET"})
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
     * @Route("/prices", name="show_price", methods={"GET"})
     * @param PriceRepository $priceRepository
     * @return Response
     */
    public function showPrice(PriceRepository $priceRepository)
    {
        return $this->render('wild/price.html.twig', [
            'prices' => $priceRepository->findAll()
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
