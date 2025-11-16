<?php

namespace App\Controller;

use App\Repository\VoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Voiture;
use App\Form\VoitureForm;


final class VoitureController extends AbstractController
{
    #[Route('/voitures', name: 'app_voiture')]
    public function listeVoiture(VoitureRepository $vr): Response
    {
        $voitures = $vr->findAll();

        return $this->render('voiture/listeVoiture.html.twig', [
                'listeVoiture' => $voitures,
        ]);
    }

    #[Route('/addVoiture', name: 'add_voiture')]
    public function addVoiture(Request $request, EntityManagerInterface $em): Response
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoitureForm::class, $voiture);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($voiture);
            $em->flush();

            return $this->redirectToRoute('app_voiture');
        }

        return $this->render('voiture/addVoiture.html.twig', [
                'formV' => $form->createView(),
        ]);
    }

    #[Route('/voiture/{id}', name: 'voitureDelete')]
    public function delete(EntityManagerInterface $em, VoitureRepository $vr, int $id): Response
    {
        $voiture = $vr->find($id);

        if (!$voiture) {
            throw $this->createNotFoundException('Voiture non trouvée');
        }

        $em->remove($voiture);
        $em->flush();

        return $this->redirectToRoute('app_voiture');
    }

    #[Route('/updateVoiture/{id}', name: 'voitureUpdate')]
    public function updateVoiture(Request $request, EntityManagerInterface $em, VoitureRepository $vr, int $id): Response
    {
        $voiture = $vr->find($id);

        if (!$voiture) {
            throw $this->createNotFoundException('Voiture non trouvée');
        }

        $editForm = $this->createForm(VoitureForm::class, $voiture);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->persist($voiture);
            $em->flush();

            return $this->redirectToRoute('app_voiture');
        }

        return $this->render('voiture/updateVoiture.html.twig', [
                'editFormVoiture' => $editForm->createView(),
        ]);
    }
}