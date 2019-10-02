<?php

namespace Gestion\CourtierBundle\Controller;

use AppBundle\Entity\Compagnie;
use AppBundle\Entity\Courtier;
use AppBundle\Entity\CourtierCompagnie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@GestionCourtier/Default/index.html.twig');
    }


    public function ajoutAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if ($request->isMethod('post')) {
            $ch= $request->get('checked');
            $c = $em->getRepository(Courtier::class)->find($this->getUser()->getId());
            foreach ($ch as $che) {
                $compagnie = $em->getRepository(Compagnie::class)->find($che);
                $courtierCompagnie = new CourtierCompagnie();
                $courtierCompagnie->setCompagnie($compagnie);
                $courtierCompagnie->setCourtier($c);
                $courtierCompagnie->setAccept(false);
                $em->persist($courtierCompagnie);
            }
            $em->flush();
            return $this->redirectToRoute('gestion_courtier_homepage');

        }
        $compagnies = $em->getRepository('AppBundle:Compagnie')->findAll();


        return $this->render('@GestionCourtier/Default/ajout.html.twig', array(
            'compagnies' => $compagnies,

        ));
    }


}
