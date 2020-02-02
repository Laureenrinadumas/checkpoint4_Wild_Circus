<?php

namespace App\Controller;

use App\Entity\Performance;
use App\Form\PerformanceType;
use App\Repository\PerformanceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/performance")
 */
class PerformanceController extends AbstractController
{
    /**
     * @Route("/", name="performance_index", methods={"GET"})
     * @param PerformanceRepository $performanceRepository
     * @return Response
     */
    public function index(PerformanceRepository $performanceRepository): Response
    {
        return $this->render('performance/index.html.twig', [
            'performances' => $performanceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="performance_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function new(Request $request, MailerInterface $mailer): Response
    {
        $performance = new Performance();
        $form = $this->createForm(PerformanceType::class, $performance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($performance);
            $entityManager->flush();

            $email = (new Email())
                ->from($this->getParameter('mailer_from'))
                ->to('laureen262@gmail.com')
                ->subject('A new performance in our next event is coming!')
                ->html($this->renderView('email/notification.html.twig',
                    ['performance' => $performance]));

            $mailer->send($email);

            return $this->redirectToRoute('performance_index');
        }

        return $this->render('performance/new.html.twig', [
            'performance' => $performance,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="performance_show", methods={"GET"})
     * @param Performance $performance
     * @return Response
     */
    public function show(Performance $performance): Response
    {
        return $this->render('performance/show.html.twig', [
            'performance' => $performance,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="performance_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Performance $performance
     * @return Response
     */
    public function edit(Request $request, Performance $performance): Response
    {
        $form = $this->createForm(PerformanceType::class, $performance);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('performance_index');
        }

        return $this->render('performance/edit.html.twig', [
            'performance' => $performance,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="performance_delete", methods={"DELETE"})
     * @param Request $request
     * @param Performance $performance
     * @return Response
     */
    public function delete(Request $request, Performance $performance): Response
    {
        if ($this->isCsrfTokenValid('delete'.$performance->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($performance);
            $entityManager->flush();
        }

        return $this->redirectToRoute('performance_index');
    }
}
