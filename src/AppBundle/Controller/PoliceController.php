<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Police;
use AppBundle\Form\PoliceType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Police controller.
 */
class PoliceController extends Controller
{
    /**
     * Lists all contrat entities.
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $contrats = $em->getRepository(Police::class)->findAll();

        return $this->render('contrat/index.html.twig', array(
            'contrats' => $contrats,
        ));
    }

    /**
     * Creates a new contrat entity.
     */
    public function newAction(Request $request)
    {
        $contrat = new Police();
        $form = $this->createForm(PoliceType::class, $contrat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($contrat);
            $em->flush();

            return $this->redirectToRoute('police_show', array('id' => $contrat->getId()));
        }

        return $this->render('contrat/new.html.twig', array(
            'contrat' => $contrat,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a contrat entity.
     *
     */
    public function showAction(Police $contrat)
    {
        $deleteForm = $this->createDeleteForm($contrat);

        return $this->render('contrat/show.html.twig', array(
            'contrat' => $contrat,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing contrat entity.
     *
     */
    public function editAction(Request $request, Police $contrat)
    {
        $deleteForm = $this->createDeleteForm($contrat);
        $editForm = $this->createForm(PoliceType::class, $contrat);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('police_edit', array('id' => $contrat->getId()));
        }
        return $this->render('contrat/edit.html.twig', array(
            'contrat' => $contrat,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a contrat entity.
     *
     */
    public function deleteAction(Request $request, Police $contrat)
    {
        $form = $this->createDeleteForm($contrat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($contrat);
            $em->flush();
        }

        return $this->redirectToRoute('police_index');
    }

    /**
     * Creates a form to delete a contrat entity.
     *
     * @param Police $contrat The contrat entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(Police $contrat)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('police_delete', array('id' => $contrat->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
