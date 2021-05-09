<?php

namespace App\Controller;

use App\Entity\SousCat;
use App\Form\SousCat1Type;
use App\Repository\SousCatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sous/cat")
 */
class SousCatController extends AbstractController
{
    /**
     * @Route("/", name="sous_cat_index", methods={"GET"})
     */
    public function index(SousCatRepository $sousCatRepository): Response
    {
        return $this->render('sous_cat/index.html.twig', [
            'sous_cats' => $sousCatRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sous_cat_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sousCat = new SousCat();
        $form = $this->createForm(SousCat1Type::class, $sousCat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sousCat);
            $entityManager->flush();

            return $this->redirectToRoute('sous_cat_index');
        }

        return $this->render('sous_cat/new.html.twig', [
            'sous_cat' => $sousCat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sous_cat_show", methods={"GET"})
     */
    public function show(SousCat $sousCat): Response
    {
        return $this->render('sous_cat/show.html.twig', [
            'sous_cat' => $sousCat,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sous_cat_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SousCat $sousCat): Response
    {
        $form = $this->createForm(SousCat1Type::class, $sousCat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sous_cat_index');
        }

        return $this->render('sous_cat/edit.html.twig', [
            'sous_cat' => $sousCat,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sous_cat_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SousCat $sousCat): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sousCat->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sousCat);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sous_cat_index');
    }
}
