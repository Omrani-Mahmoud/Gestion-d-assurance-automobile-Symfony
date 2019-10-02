<?php

namespace Gestion\ExpertBundle\Controller;

use AppBundle\Entity\Expert;
use AppBundle\Entity\Police;
use AppBundle\Entity\Reclamation;
use AppBundle\Entity\Sinistre;
use Doctrine\Common\Collections\ArrayCollection;
use Gestion\ExpertBundle\Form\RapportType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('GestionExpertBundle:Default:index.html.twig');
    }

    public function getReclamationAction()
    {
        $em = $this->getDoctrine()->getManager();
        if ($this->getUser()) {
            $expert = $em->getRepository(Expert::class)->find($this->getUser()->getId());
            $reclamations = $em->getRepository(Reclamation::class)->findBy(array(
                'expert' => $expert->getId()
            ));
            return $this->render('@GestionExpert/Default/listReclamation.html.twig', array(
                'reclamation' => $reclamations
            ));
        }
    }

    public function showReclamationAction(Request $request, $codeRec)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $reclamation = $entityManager->getRepository(Reclamation::class)->find($codeRec);
        $form = $this->createForm(RapportType::class, $reclamation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('gestion_expert_rapport',array(
                'idExpert'=> $reclamation->getExpert()->getId()
            ));
        }

        return $this->render('@GestionExpert/Default/showReclamation.html.twig', array(
            'reclamation' => $reclamation,
            'form' => $form->createView()
        ));
    }

    public function getRapportAction($idExpert)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $reclamation = $entityManager->getRepository(Reclamation::class)->findBy(array(
            'expert' => $idExpert
        ));

        return $this->render('@GestionExpert/Default/showRapport.html.twig', array(
            'reclamation' => $reclamation,
        ));

    }

}
