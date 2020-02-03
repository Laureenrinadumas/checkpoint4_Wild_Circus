<?php

namespace App\Controller;


use App\Entity\Performance;
use App\Repository\ContentRepository;
use App\Repository\PerformanceRepository;
use App\Repository\PriceRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route ("/perfoms", name="show_performs", methods={"GET","POST"})
     * @return Response
     */
    public function showPerformance(PerformanceRepository $performanceRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $data = $this->getDoctrine()->getRepository(Performance::class)->findAll([]);

        $performances = $paginator->paginate(
            $data,
            $request->query->getInt('page', 1),
            4
        );

        return $this->render('wild/performance_info.html.twig', [
            'performances' => $performances,
        ]);
    }

    /**
     * @Route("/prices", name="show_price", methods={"GET"})
     * @param PriceRepository $priceRepository
     * @return string
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
