<?php

namespace App\Controller;

use App\Entity\Inscrit;
use App\Form\InscritType;
use App\Repository\InscritRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/inscrit")
 */
class InscritController extends AbstractController
{
    /**
     * @Route("/", name="inscrit_index", methods={"GET"})
     */
    public function index(InscritRepository $inscritRepository): Response
    {
        return $this->render('inscrit/index.html.twig', [
            'inscrits' => $inscritRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="inscrit_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $inscrit = new Inscrit();
        $form = $this->createForm(InscritType::class, $inscrit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($inscrit);
            $entityManager->flush();

            return $this->redirectToRoute('inscrit_index');
        }

        return $this->render('inscrit/new.html.twig', [
            'inscrit' => $inscrit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="inscrit_show", methods={"GET"})
     */
    public function show(Inscrit $inscrit): Response
    {
        return $this->render('inscrit/show.html.twig', [
            'inscrit' => $inscrit,
        ]);
    }
    public function contact()
    {
        return $this->render('inscrit/contact.html.twig');
    }

    /**
     * @Route("/{id}/edit", name="inscrit_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Inscrit $inscrit): Response
    {
        $form = $this->createForm(InscritType::class, $inscrit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('inscrit_index');
        }

        return $this->render('inscrit/edit.html.twig', [
            'inscrit' => $inscrit,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="inscrit_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Inscrit $inscrit): Response
    {
        if ($this->isCsrfTokenValid('delete'.$inscrit->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($inscrit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('inscrit_index');
    }
}
