<?php

namespace Gestion\ContratBundle\Controller;

use AppBundle\AppBundle;
use AppBundle\Entity\Agence;
use AppBundle\Entity\Assure;
use AppBundle\Entity\AvenantPolice;
use AppBundle\Entity\Compagnie;
use AppBundle\Entity\Constat;
use AppBundle\Entity\GarantieComplementaire;
use AppBundle\Entity\Police;
use AppBundle\Entity\PrimeRC;
use AppBundle\Entity\Reclamation;
use AppBundle\Entity\Sinistre;
use AppBundle\Entity\Temoin;
use AppBundle\Entity\Vehicule;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Gestion\ContratBundle\Entity\CompagnieAgenceCouple;
use Gestion\ContratBundle\GestionContratBundle;
use Mremi\ContactBundle\Form\Type\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@GestionContrat/Default/Forms/Vehicule.html.twig');

    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function getUserAction()
    {
        return $this->render('@GestionContrat/Default/Forms/user.html.twig');
    }

    public function listepoliceAction()
    {
        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getId();
        $res = $em->getRepository(Police::class)->findBy(array('codeAssure' => $id));
        return $this->render('@GestionContrat/Default/listepolice.html.twig', array('ls' => $res));

    }


    public function listevehiculeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getId();

        $contrat = $em->getRepository(Police::class)->findOneBy(array(
            'codeAssure' => $id
        ));
//        foreach ($contrat as $c) {
            $vehicule = $em->getRepository(Vehicule::class)->findBy(array(
                'refContrat' => $contrat->getId()
            ));
//        }
        return $this->render('@GestionContrat/Default/listevehicule.html.twig', array(
            'ls' => $vehicule
        ));


    }

    public function listeavenantpoliceAction(Request $request)
    {
        $reader = $this->container->get('dh_doctrine_audit.reader');
        $logs = $reader->getAudits(Police::class);
        return $this->render('@GestionContrat/Default/listeavenantpolice.html.twig', array(

            'ls' => $logs
        ));



    }

    public function listeconstatAction()
    {
        $t = null;
        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getid();
        $contrat = $em->getRepository(Police::class)->findBy(array('codeAssure' => $id
        ));
        foreach ($contrat as $c) {
            $sinistre = $em->getRepository(Sinistre::class)->findBy(array(

                'contrat' => $c->getId()
            ));
            foreach ($sinistre as $a) {
                $req = $$em->getRepository(Reclamation::class)->findBy(array(

                    'codeSinistre' => $a->getCode()
                ));
            }
            $consta = $em->getRepository(Constat::class)->findBy(array(
                'codeSinistre' => $req->getcodeRec()
            ));

        }
        return $this->render('@GestionContrat/Default/listeconstat.html.twig', array(

            'ls' => $consta
        ));


    }

    public function listereclamationAction()
    {
        $t = null;
        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getid();
        $contrat = $em->getRepository(Police::class)->findBy(array('id' => $id
        ));
        foreach ($contrat as $c) {
            $sinistre = $em->getRepository(Sinistre::class)->findBy(array(

                '$reclamation' => $c->getId()
            ));
            foreach ($sinistre as $a) {
                $t = $$em->getRepository(Reclamation::class)->findBy(array(

                    'sinistre' => $a->getCode()
                ));
            }
        }

        return $this->render('@GestionContrat/Default/listereclamation.html.twig', array(

            'ls' => $t
        ));

    }

    public function listesinistreAction()
    {

        $avenant = null;
        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getid();
        $police = $em->getRepository(Police::class)->findBy(array('codeAssure' => $id
        ));
        foreach ($police as $c) {
            $sinistre = $em->getRepository(Sinistre::class)->findBy(array(

                'contrat' => $c->getId()
            ));
        }

        return $this->render('@GestionContrat/Default/listesinistre.html.twig', array(

            'ls' => $avenant
        ));


    }

    public function listetemoinAction()
    {
        $t = null;
        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getid();
        $contrat = $em->getRepository(Police::class)->findBy(array('codeAssure' => $id
        ));
        foreach ($contrat as $c) {
            $sini = $em->getRepository(Sinistre::class)->findBy(array(

                'contrat' => $c->getId()
            ));
            foreach ($sini as $a) {
                $t = $$em->getRepository(Temoin::class)->findBy(array(

                    'sinistre' => $a->getTemoins()
                ));
            }
        }

        return $this->render('@GestionContrat/Default/listetemoin.html.twig', array(
            'ls' => $t
        ));
    }

    public function profileAction()
    {   $reader = $this->container->get('dh_doctrine_audit.reader');
        $logs = $reader->getAudits(Police::class);
        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getid();
        $tel=$this->getUser()->getTel();
        $nom=$this->getUser()->getNom();
        $prenom=$this->getUser()->getPrenom();
        $cin=$this->getUser()->getCin();
        $adresse=$this->getUser()->getAdresse();
        $fax=$this->getUser()->getFax();
        $profession=$this->getUser()->getProfession();
        $montant=$contrat = $em->getRepository(Police::class)->findOneBy(array('codeAssure' => $id
        ))->getMontant();

        $contrat = $em->getRepository(Police::class)->findBy(array('codeAssure' => $id
        ));

        $em = $this->getDoctrine()->getManager();
        $id = $this->getUser()->getId();
        $res = $em->getRepository(Police::class)->findBy(array('codeAssure' => $id));

        return $this->render('@GestionContrat/Default/profile.html.twig', array(
            'ls' => $logs,
            'police' => $res,
            'tel'=>$tel,
            'nom'=>$nom,
            'prenom'=>$prenom,
            'cin'=>$cin,
            'adresse'=>$adresse,
            'fax'=>$fax,
            'profession'=>$profession,
            'montant'=>$montant
        ));
    }

    public function comparaisonAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->isMethod('POST')) {
            $chassis = $request->get('num_chassis');
            $modele = $request->get('modele');
            $puissance = $request->get('puissance');
            $carburant = $request->get('carburant');
            $valvenal = $request->get('valvenal');
            $v = new Vehicule($chassis, $modele, $puissance, $carburant);
            $v->setValVenale($valvenal);
            $compagnie = $em->getRepository(Compagnie::class)->findAll();
            $compagnies = new ArrayCollection();
            foreach ($compagnie as $c) {
                $couple = new CompagnieAgenceCouple($c);
                $agences = $em->getRepository(Agence::class)->findBy(array(
                    'compagnie'=>$c
                ));
                $couple->setAgence($agences);
                $compagnies->add($couple);
            }
            $garantis = $em->getRepository(GarantieComplementaire::class)->findAll();
            $primerc = $em->getRepository(PrimeRC::class)->findOneBy(array(
                'puissanceFiscale' => $v->getPuissance()
            ));
            $form = $this->createForm(ContactType::class);
            return $this->render('@GestionContrat/Default/Forms/comparaison.html.twig', array(
                'vehicule' => $v,
                'garantis' => $garantis,
                'compagnies' => $compagnies,
                'primerc' => $primerc,
                'form'=>$form->createView()
            ));
        }
        return $this->render('@GestionContrat/Default/Forms/comparaison.html.twig');
    }

    public function getGarantiAction(Request $request)
    {
        if ($request->isXMLHttpRequest()) {
            $id = $_POST['id'];
            $valvenal = $_POST['valvenal'];
            $em = $this->getDoctrine()->getManager();
            $garantiComp = $em->getRepository(GarantieComplementaire::class)->find($id);
            $garanti = 0;
            if ($garantiComp->getTarifDeBase()) {
                $garanti = $garantiComp->getTarifDeBase();
            } else {
                $garanti = $garantiComp->getPrimeDeBase() + $garantiComp->getSurprime() * $valvenal;
            }
            return new JsonResponse(array('prix' => $garanti));
        }

        return new Response('This is not ajax!', 400);
    }

    public function userAction(Request $request){

        $form = $this->createForm(ContactType::class);
        if ($request->isMethod('POST')) {
            $chassis = $request->get('num_chassis');
            $modele = $request->get('modele');
            $puissance = $request->get('puissance');
            $carburant = $request->get('carburant');
            $valvenal = $request->get('valvenal');
            $agence_id = $request->get('agence');
            $garantis = $request->get('garanti');
            $v = new Vehicule($chassis, $modele, $puissance, $carburant);
            $v->setValVenale($valvenal);
            return $this->render('@GestionContrat/Default/Forms/user.html.twig', array(
                'vehicule' => $v,
                'garantis' => $garantis,
                'agence' => $agence_id,
                'form'=>$form->createView()
            ));
        }
        return $this->render('@GestionContrat/Default/Forms/comparaison.html.twig', array(
            'form'=>$form->createView()
        ));
    }

    public function assureAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $encoder = $this->get('security.password_encoder');
        if ($request->isMethod('POST')) {
            $firstname = $request->get('first-name');
            $lastname = $request->get('last-name');
            $cin = $request->get('CIN');
            $email = $request->get('mail');
            $adresse = $request->get('Adresse');
            $tel = $request->get('Tel');
            $profession = $request->get('Profession');
            $birthdate = new DateTime($request->get('birthdate'));
            $gender = $request->get('gender');
            $chassis = $request->get('num_chassis');
            $modele = $request->get('modele');
            $puissance = $request->get('puissance');
            $carburant = $request->get('carburant');
            $valvenal = $request->get('valvenal');
            $agence_id = $request->get('agence');
            $v = new Vehicule($chassis, $modele, $puissance, $carburant);
            $v->setValVenale($valvenal);
            $primerc = $em->getRepository(PrimeRC::class)->findOneBy(array(
               'puissanceFiscale'=>$puissance
            ));
            $v->setPrimeRC($primerc);
            $a = new Assure($firstname . "_" . $lastname, $email, "ROLE_ASSURE");
            $a->setEnabled(false);
            $a->setAdresse($adresse);
            $a->setTel($tel);
            $a->setCin($cin);
            $a->setProfession($profession);
            $a->setBirthdate($birthdate);
            $a->setGender($gender);
            $encoded= $encoder->encodePassword($a, '12345');
            $a->setPassword($encoded);
            $p = new Police();
            $p->setClasse(8);
            $p->setCoefClasse(2);
            $p->setDateEffetPolice(new DateTime('now'));
            $garantis = new ArrayCollection();
            foreach($request->get('garantis') as $g){
                $garanti = $em->getRepository(GarantieComplementaire::class)->find($g);
                $garantis->add($garanti);
            }
            $p->setGarantis($garantis);
            $p->setCodeAssure($a);
            $agence = $em->getRepository(Agence::class)->find($agence_id);
            $p->setAgence($agence);
            $a->setContrats([$p]);
            $v->setRefContrat($p);
            $v->setDateCircule(new DateTime('now'));
            $em->persist($a);
            $em->persist($p);
            $em->persist($v);
            $em->flush();

            $form = $this->createForm(ContactType::class);
            return $this->render('::indiv.html.twig', array(
                'form'=>$form->createView()
            ));
        }
        $form = $this->createForm(ContactType::class);
        return $this->render('@GestionContrat/Default/Forms/Vehicule.html.twig', array(
            'form'=>$form->createView()
        ));
    }
}



