<?php

namespace Gestion\CompagnieBundle\Controller;

use AppBundle\Entity\Agence;
use AppBundle\Entity\Assure;
use AppBundle\Entity\AvenantPolice;
use AppBundle\Entity\Compagnie;
use AppBundle\Entity\Courtier;
use AppBundle\Entity\CourtierCompagnie;
use AppBundle\Entity\GarantieComplementaire;
use AppBundle\Entity\Police;
use AppBundle\Entity\Sinistre;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getId();
        $agence = $em->getRepository(Agence::class)->findBy(array(
            'compagnie' => $id
        ));
        foreach ($agence as $age) {
            $contrat = $em->getRepository(Police::class)->findBy(array(
                'agence' => $age->getIdAgence()
            ));
            foreach ($contrat as $pl) {
                $sinistre = $em->getRepository(Sinistre::class)->findBy(array(
                    'contrat' => $pl->getId()
                ));
                $assure = $em->getRepository(Assure::class)->findBy(array(
                    'id' => $pl->getCodeAssure()
                ));
                foreach ($assure as $assu) {
                    $user = $em->getRepository(Assure::class)->findBy(array(
                        'enabled' => '1'
                    ));
                }
            }
        }

        return $this->render('@GestionCompagnie/Default/index.html.twig', array(
            'id' => $id,
            'agence' => $agence,
            'police' => $this->statContratAction(),
            'sinistre' => $sinistre,
            'assure' => $user,

            ## display assure with enbaled = 0 ##
            'assureDis' => $this->AssureNotEnabledAction(),
            ## display courtier with enbaled = 0 ##
            'courtierDis' => $this->CourtierNotEnabledAction()
        ));


    }


    function searchAgenceAction()
    {
        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getId();

        $res = $em->getRepository(Agence::class)->findBy(array(
            'compagnie' => $id
        ));
        return $this->render('@GestionCompagnie/Default/listAgence.html.twig', array(
            'ls' => $res
        ));
    }

    function searcheGarantieAction()
    {
        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getId();
        $res = $em->getRepository(GarantieComplementaire::class)->findBy(array(
            'compagnie' => $id
        ));
        return $this->render('@GestionCompagnie/Default/listGarantie.html.twig', array(
            'ls' => $res
        ));
    }

    function listeAssureAction()
    {
        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getId();

        $agence = $em->getRepository(Agence::class)->findBy(array(
            'compagnie' => $id
        ));

        foreach ($agence as $age) {
            $contrat = $em->getRepository(Police::class)->findBy(array(
                'agence' => $age->getIdAgence()
            ));

            foreach ($contrat as $cont) {
                $assure = $em->getRepository(Assure::class)->findBy(array(
                    'id' => $cont->getCodeAssure()
                ));
                foreach ($assure as $assu) {
                    $user = $em->getRepository(Assure::class)->findBy(array(
                        'enabled' => '1'
                    ));
                }

            }
        }

        return $this->render('@GestionCompagnie/Default/listAssure.html.twig', array(

            'ls' => $user

        ));
    }

    function listeContratAction()
    {
        $contrat=new ArrayCollection();
        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getId();

        $res = $em->getRepository(Agence::class)->findBy(array(
            'compagnie' => $id
        ));
        foreach ($res as $age) {
            $contrat->add($em->getRepository(Police::class)->findBy(array(
                'agence' => $age->getIdAgence()
            )));


        }
        return $this->render('@GestionCompagnie/Default/listPolice.html.twig', array(

            'ls' => $contrat
        ));
    }

    function listeCourtierAction()
    {
        $courtier = new ArrayCollection();
        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getId();
        $compagnie = $em->getRepository(CourtierCompagnie::class)->findBy(array(
            'compagnie' => $id,
            'accept' => '1'
        ));

        foreach ($compagnie as $court) {

            $courtier->add($court->getCourtier());
        }

        return $this->render('@GestionCompagnie/Default/listCourtier.html.twig', array(
            'ls' => $courtier
        ));
    }

    function listeAvenantAction()
    {
        $reader = $this->container->get('dh_doctrine_audit.reader');
        $logs = $reader->getAudits(Police::class);
        return $this->render('@GestionCompagnie/Default/listAvenant.html.twig', array(

            'logs' => $logs
        ));

    }


    function BonusAction()
    {
        $date = new \DateTime('now');
        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getId();
        $agence = $em->getRepository(Agence::class)->findBy(array(
            'compagnie' => $id
        ));
        foreach ($agence as $age) {
            $contrat = $em->getRepository(Police::class)->findBy(array(
                'agence' => $age->getIdAgence()
            ));


            foreach ($contrat as $con) {

                $idContart = $con->getId();
                $sinistre = $em->getRepository(Sinistre::class)->findBy(
                    array('contrat' => $idContart),
                    array('code' => 'DESC')
                );
            }
            var_dump($sinistre);
            $endTab = end($sinistre);

            $dateS = $sinistre->getDateSinistre();

            $deff = date_diff($dateS, $date);

            if ($deff > 2) {
                $police = $em->getRepository(Police::class)->findBy(array(
                    'id' => $endTab->getContrat()
                ));
                $class = $police->getClasse();
                $police->setClasse($class - 1);
                $em->persist($police);
            }


        }

    }


    function AssureNotEnabledAction()
    {
        $lassure = null;
        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getId();

        $agence = $em->getRepository(Agence::class)->findBy(array(
            'compagnie' => $id
        ));

        foreach ($agence as $age) {
            $contrat = $em->getRepository(Police::class)->findBy(array(
                'agence' => $age->getIdAgence()
            ));

            foreach ($contrat as $cont) {
                $lassure = $em->getRepository(Assure::class)->findBy(array
                (
                    'id' => $cont->getCodeAssure()
                ));

                foreach ($lassure as $assu) {
                    $user = $em->getRepository(Assure::class)->findBy(array(
                        'enabled' => '0'
                    ));
                }
            }
        }

        return $user;

    }


    public function ajoutAssureAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->isMethod('post')) {
            $checked = $request->get('checked');
            foreach ($checked as $ch) {
                $assured = $em->getRepository(Assure::class)->find($ch);
                $assured->setEnabled(1);
                $em->persist($assured);
            }
            $em->flush();
            return $this->redirectToRoute('gestion_compagnie_home');
        }

    }


    function CourtierNotEnabledAction()
    {
        $courtierDisabled = new ArrayCollection();
        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getId();
        $compagnie = $em->getRepository(CourtierCompagnie::class)->findBy(array(
            'compagnie' => $id,
            'accept' => '0'
        ));

        foreach ($compagnie as $court) {

            $courtierDisabled->add($court->getCourtier());
        }

        return $courtierDisabled;
    }


    public function ajoutCourtierAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getId();
        if ($request->isMethod('post')) {
            $checked = $request->get('checkedC');
            foreach ($checked as $ch) {

                $courtier = $em->getRepository(CourtierCompagnie::class)->find(array(
                    'courtier' => $ch,
                    'compagnie' => $id
                ));
                $courtier->setAccept(true);
            }
            $em->flush();
            return $this->redirectToRoute('gestion_compagnie_home');
        }

    }

    public function DeleteCourtierAction($idC, $id)
    {
        {
            $em = $this->getDoctrine()->getManager();
            $toDel = $em->getRepository(CourtierCompagnie::class)->findOneBy(array(
                'courtier' => $idC,
                'compagnie' => $id

            ));
            $em->remove($toDel);
            $em->flush();
            return $this->redirectToRoute('gestion_compagnie_home');

        }

    }

    function statContratAction()
    {
        $contrat=new ArrayCollection();
        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getId();

        $res = $em->getRepository(Agence::class)->findBy(array(
            'compagnie' => $id
        ));
        foreach ($res as $age) {
            $contrat->add($em->getRepository(Police::class)->findBy(array(
                'agence' => $age->getIdAgence()
            )));


        }
        return $contrat;
    }
}

