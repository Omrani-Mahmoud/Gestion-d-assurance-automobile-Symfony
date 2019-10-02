<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Temoin;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Temoin controller.
 *
 */
class TemoinController extends Controller
{
    /**
     * Lists all temoin entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $temoins = $em->getRepository('AppBundle:Temoin')->findAll();

        return $this->render('temoin/index.html.twig', array(
            'temoins' => $temoins,
        ));
    }

    /**
     * Creates a new temoin entity.
     *
     */
    public function newAction(Request $request)
    {
        $temoin = new Temoin();
        $form = $this->createForm('AppBundle\Form\TemoinType', $temoin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($temoin);
            $em->flush();

            return $this->redirectToRoute('temoin_show', array('cint' => $temoin->getCint()));
        }

        return $this->render('temoin/new.html.twig', array(
            'temoin' => $temoin,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a temoin entity.
     *
     */
    public function showAction(Temoin $temoin)
    {
        $deleteForm = $this->createDeleteForm($temoin);

        return $this->render('temoin/show.html.twig', array(
            'temoin' => $temoin,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing temoin entity.
     *
     */
    public function editAction(Request $request, Temoin $temoin)
    {
        $deleteForm = $this->createDeleteForm($temoin);
        $editForm = $this->createForm('AppBundle\Form\TemoinType', $temoin);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('temoin_edit', array('cint' => $temoin->getCint()));
        }

        return $this->render('temoin/edit.html.twig', array(
            'temoin' => $temoin,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a temoin entity.
     *
     */
    public function deleteAction(Request $request, Temoin $temoin)
    {
        $form = $this->createDeleteForm($temoin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($temoin);
            $em->flush();
        }

        return $this->redirectToRoute('temoin_index');
    }

    /**
     * Creates a form to delete a temoin entity.
     *
     * @param Temoin $temoin The temoin entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Temoin $temoin)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('temoin_delete', array('cint' => $temoin->getCint())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
