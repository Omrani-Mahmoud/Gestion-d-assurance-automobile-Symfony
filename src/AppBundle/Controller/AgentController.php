<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Agence;
use AppBundle\Entity\Agent;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Agent controller.
 *
 */
class AgentController extends Controller
{
    /**
     * Lists all agent entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $agence = $this->getUser()->getAgence();
        $agents = $em->getRepository(Agent::class)->findBy(array(
                'agence'=>$agence
            ));


        return $this->render('agent/index.html.twig', array(
            'agents' => $agents,
        ));
    }

    /**
     * Creates a new agent entity.
     *
     */
    public function newAction(Request $request,UserPasswordEncoderInterface $encoder)
    {
        $agent = new Agent(null, null, null);
        $agent->setRoles(["ROLE_AGENT"]);
        $encoded = $encoder->encodePassword($agent, '12345');
        $agent->setPassword($encoded);
        $form = $this->createForm('AppBundle\Form\AgentType', $agent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($agent);
            $em->flush();

            return $this->redirectToRoute('agent_show', array('id' => $agent->getId()));
        }

        return $this->render('agent/new.html.twig', array(
            'agent' => $agent,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a agent entity.
     *
     */
    public function showAction(Agent $agent)
    {
        $deleteForm = $this->createDeleteForm($agent);

        return $this->render('agent/show.html.twig', array(
            'agent' => $agent,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing agent entity.
     *
     */
    public function editAction(Request $request, Agent $agent)
    {
        $deleteForm = $this->createDeleteForm($agent);
        $editForm = $this->createForm('AppBundle\Form\AgentType', $agent);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('agent_edit', array('id' => $agent->getId()));
        }

        return $this->render('agent/edit.html.twig', array(
            'agent' => $agent,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a agent entity.
     *
     */
    public function deleteAction(Request $request, Agent $agent)
    {
        $form = $this->createDeleteForm($agent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($agent);
            $em->flush();
        }

        return $this->redirectToRoute('agent_index');
    }

    /**
     * Creates a form to delete a agent entity.
     *
     * @param Agent $agent The agent entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Agent $agent)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('agent_delete', array('id' => $agent->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
