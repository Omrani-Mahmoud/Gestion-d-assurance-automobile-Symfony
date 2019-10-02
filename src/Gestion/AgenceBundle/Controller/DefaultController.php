<?php

namespace Gestion\AgenceBundle\Controller;

use AppBundle\Entity\Agent;
use AppBundle\Entity\Assure;
use AppBundle\Entity\Expert;
use AppBundle\Entity\Police;
use AppBundle\Entity\Reclamation;
use AppBundle\Entity\Sinistre;
use AppBundle\Entity\Vehicule;
use Doctrine\Common\Collections\ArrayCollection;
use Gestion\AgenceBundle\GestionAgenceBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->redirectToRoute('gestion_agent');
    }

    function listePoliceAction()
    {
        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getIdAgence();

        $assure = $em->getRepository(Assure::class)->findBy(array(
            'enabled'=>true
        ));
        $contrat = new ArrayCollection();
        foreach($assure as $a){
            $contrat->add($em->getRepository(Police::class)->findBy(array(
                'codeAssure'=>$a,
                'agence' => $id
            )));
        }
        return $this->render('@GestionAgence/Default/liste_police.html.twig',array(

            'lsContrat' => $contrat
        ));
        }



    public function demandeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getIdAgence();
        $this->ajoutAssureAction($request);


        $contrat= $em->getRepository(Police::class)->findBy(array(
            'agence' => $id
        ));
        foreach($contrat as $c){
            $assure = $em->getRepository(Assure::class)->findBy(array(
                'enabled'=>false,
                'id'=>$c->getCodeAssure()

            ));
        }

        return $this->render('@GestionAgence/Default/demandes.html.twig', array(
                'assures'=> $assure));

    }





    public function getAgentAction()
    {
        $em = $this->getDoctrine()->getManager();
        $agence = $this->getUser()->getAgence();

        $res = $em->getRepository(Agent::class)->findBy(array(
            'agence' => $agence
        ));

        return $this->render('@GestionAgence/Default/liste_agent.html.twig', array(

                'ls' => $res

        ));
    }

    public function getReclamationAction()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $zoneExpert = $this->getUser()->getAgence()->getZone();

        $resultat = $entityManager->getRepository(Expert::class)->findBy(array(
            'zoneExp' => $zoneExpert
        ));
        $agent = $entityManager->getRepository(Agent::class)->find($this->getUser()->getId());
        $listePolicesAgenceCourant = $entityManager->getRepository(Police::class)->findBy(array(
            'agence' => $agent->getAgence()
        ));
        $listeReclamationsAgenceCourant = new ArrayCollection();

        foreach ($listePolicesAgenceCourant as $police) {
            foreach ($police->getSinistres() as $s) {
                if ($s) {

                    $listeReclamationsAgenceCourant->add($entityManager->getRepository(Reclamation::class)->findBy(array(
                        "codeSinistre" => $s->getCode()
                    )));
                }
            }
        }

        return $this->render('@GestionAgence/Default/reclamation.html.twig', array(
            'expert' => $resultat,
            'reclamations' => $listeReclamationsAgenceCourant
        ));
    }

    public function getExpertAction()
    {
        $em = $this->getDoctrine()->getManager();
        $zone = $this->getUser()->getZone();
        $res = $em->getRepository(Expert::class)->findBy(array(
            'zoneExp' => $zone
        ));
        return $this->render('@GestionAgence/Default/liste_expert.html.twig', array(
            'ls' => $res

        ));
    }

    public function getVehiculeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $chassis = $this->getDoctrine()->getManager();
        $res = $em->getRepository(Vehicule::class)->findBy(array(
            'chassis' => $chassis
        ));
        return $this->render('@GestionAgence/Default/liste_vehicule.html.twig', array(
            'ls' => $res
        ));
    }

    public function getRapportAction(Request $request, $codeRec)
    {
        $em = $this->getDoctrine()->getManager();
        $res = $em->getRepository(Reclamation::class)->findOneBy(array(
            'codeRec' => $codeRec
        ));
        return $this->render('@GestionAgence/Default/rapport.html.twig', array(
            'reclamation' => $res
        ));
    }
//    fonction ajax
    public function affectExpertToReclamationAction(Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            $parametre = $_POST['ajaxParameter'];
            $parametreToAffect = explode(':', $parametre);
            $entityManager = $this->getDoctrine()->getManager();
            $codeReclamation = $parametreToAffect[0];
            $idExpertToAffect = $parametreToAffect[1];
            $ExpertToAffect = $entityManager->getRepository('AppBundle\Entity\Expert')->find($idExpertToAffect);
            $reclamationToAffect = $entityManager->getRepository('AppBundle\Entity\Reclamation')->find($codeReclamation);
            $reclamationToAffect->setExpert($ExpertToAffect);
            $ExpertToAffect->setReclamations([$reclamationToAffect]);
            $entityManager->flush();
            return new JsonResponse(array('status' => 200));
        }
        return new Response('erreur ', 400);

    }

    public function ajoutAssureAction($request){
        $em = $this->getDoctrine()->getManager();
        if ($request->isMethod('post')) {
            $checked= $request->get('checkedC');
            foreach ($checked as $ch){
                $assured = $em->getRepository(Assure::class)->find($ch);
                $assured->setEnabled(1);
                $em->persist($assured);
            }
            $em->flush();
            return $this->redirectToRoute('gestion_agence_police');
        }

    }

    public function listeavenantpoliceAction(Request $request)
    {
        $reader = $this->container->get('dh_doctrine_audit.reader');
        $logs = $reader->getAudits(Police::class);
        return $this->render('@GestionAgence/Default/listeavenantpolice.html.twig', array(

            'ls' => $logs
        ));
    }
}
