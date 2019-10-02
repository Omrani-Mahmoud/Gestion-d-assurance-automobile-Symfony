<?php

namespace AppBundle\Controller;

use AppBundle\Entity\GarantieComplementaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Garantiecomplementaire controller.
 *
 */
class GarantieComplementaireController extends Controller
{
    /**
     * Lists all garantieComplementaire entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $garantieComplementaires = $em->getRepository('AppBundle:GarantieComplementaire')->findAll();

        return $this->render('garantiecomplementaire/index.html.twig', array(
            'garantieComplementaires' => $garantieComplementaires,
        ));
    }

    /**
     * Creates a new garantieComplementaire entity.
     *
     */
    public function newAction(Request $request)
    {
        $garantieComplementaire = new Garantiecomplementaire();
        $form = $this->createForm('AppBundle\Form\GarantieComplementaireType', $garantieComplementaire);
        $form->handleRequest($request);
        $id=$this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $garantieComplementaire->setCompagnie($id);
            $em->persist($garantieComplementaire);
            $em->flush();

            return $this->redirectToRoute('garantiecomplementaire_show', array('id' => $garantieComplementaire->getId()));
        }

        return $this->render('garantiecomplementaire/new.html.twig', array(
            'garantieComplementaire' => $garantieComplementaire,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a garantieComplementaire entity.
     *
     */
    public function showAction(GarantieComplementaire $garantieComplementaire)
    {
        $deleteForm = $this->createDeleteForm($garantieComplementaire);

        return $this->render('garantiecomplementaire/show.html.twig', array(
            'garantieComplementaire' => $garantieComplementaire,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing garantieComplementaire entity.
     *
     */
    public function editAction(Request $request, GarantieComplementaire $garantieComplementaire)
    {
        $deleteForm = $this->createDeleteForm($garantieComplementaire);
        $editForm = $this->createForm('AppBundle\Form\GarantieComplementaireType', $garantieComplementaire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gestion_listGarantie');
        }

        return $this->render('garantiecomplementaire/edit.html.twig', array(
            'garantieComplementaire' => $garantieComplementaire,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a garantieComplementaire entity.
     *
     */
    public function deleteAction(Request $request, GarantieComplementaire $garantieComplementaire)
    {
        $form = $this->createDeleteForm($garantieComplementaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($garantieComplementaire);
            $em->flush();
        }

        return $this->redirectToRoute('garantiecomplementaire_index');
    }

    /**
     * Creates a form to delete a garantieComplementaire entity.
     *
     * @param GarantieComplementaire $garantieComplementaire The garantieComplementaire entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(GarantieComplementaire $garantieComplementaire)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('garantiecomplementaire_delete', array('id' => $garantieComplementaire->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
