<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Agence;
use AppBundle\Entity\Agent;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Agence controller.
 *
 */
class AgenceController extends Controller
{
    /**
     * Lists all agence entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $agences = $em->getRepository('AppBundle:Agence')->findAll();

        return $this->render('agence/index.html.twig', array(
            'agences' => $agences,
        ));
    }

    /**
     * Creates a new agence entity.
     *
     */
    public function newAction(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $id = $this->getUser();
        $agence = new Agence();
        $form = $this->createForm('AppBundle\Form\AgenceType', $agence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            /* Création de l'agent general */
            $agent_general = new Agent('agent_' . preg_replace('/\s+/', '', $agence->getCompagnie()) . '_' . preg_replace('/\s+/', '', $agence->getZone()), 'agent_' . preg_replace('/\s+/', '', $agence->getCompagnie()) . '_' . preg_replace('/\s+/', '', $agence->getZone()) . '@gmail.com', 'ROLE_AGENT_GENERAL');
            $encoded = $encoder->encodePassword($agent_general, '12345');
            $agent_general->setPassword($encoded);
            $agent_general->setAgence($agence);
            $agent_general->setEnabled(true);

            $agence->setAgents([$agent_general]);
            $agence->setCompagnie($id);
            $em->persist($agence);
            $em->flush();
            return $this->redirectToRoute('agence_show', array('id' => $agence->getIdAgence()));
        }

        return $this->render('agence/new.html.twig', array(
            'agence' => $agence,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a agence entity.
     *
     */
    public function showAction(Agence $agence)
    {
        $deleteForm = $this->createDeleteForm($agence);

        return $this->render('agence/show.html.twig', array(
            'agence' => $agence,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing agence entity.
     *
     */
    public function editAction(Request $request, Agence $agence)
    {
        $deleteForm = $this->createDeleteForm($agence);
        $editForm = $this->createForm('AppBundle\Form\AgenceType', $agence);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('agence_edit', array('id' => $agence->getIdagence()));
        }

        return $this->render('agence/edit.html.twig', array(
            'agence' => $agence,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a agence entity.
     *
     */
    public function deleteAction(Request $request, Agence $agence)
    {
        $em = $this->getDoctrine()->getManager();


        $form = $this->createDeleteForm($agence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $id = $agence->getIdAgence();
            $agent = $em->getRepository(Agent::class)->findOneBy(array(
                'agence' => $id));
            $em->remove($agent);

            $em->remove($agence);
            $em->flush();
        }

        return $this->redirectToRoute('agence_index');
    }

    /**
     * Creates a form to delete a agence entity.
     *
     * @param Agence $agence The agence entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(Agence $agence)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('agence_delete', array('id' => $agence->getIdagence())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
