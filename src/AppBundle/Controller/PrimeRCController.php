<?php

namespace AppBundle\Controller;

use AppBundle\Entity\PrimeRC;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Primerc controller.
 *
 */
class PrimeRCController extends Controller
{
    /**
     * Lists all primeRC entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $primeRCs = $em->getRepository('AppBundle:PrimeRC')->findAll();

        return $this->render('primerc/index.html.twig', array(
            'primeRCs' => $primeRCs,
        ));
    }

    /**
     * Creates a new primeRC entity.
     *
     */
    public function newAction(Request $request)
    {
        $primeRC = new Primerc();
        $form = $this->createForm('AppBundle\Form\PrimeRCType', $primeRC);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($primeRC);
            $em->flush();

            return $this->redirectToRoute('primerc_show', array('id' => $primeRC->getId()));
        }

        return $this->render('primerc/new.html.twig', array(
            'primeRC' => $primeRC,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a primeRC entity.
     *
     */
    public function showAction(PrimeRC $primeRC)
    {
        $deleteForm = $this->createDeleteForm($primeRC);

        return $this->render('primerc/show.html.twig', array(
            'primeRC' => $primeRC,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing primeRC entity.
     *
     */
    public function editAction(Request $request, PrimeRC $primeRC)
    {
        $deleteForm = $this->createDeleteForm($primeRC);
        $editForm = $this->createForm('AppBundle\Form\PrimeRCType', $primeRC);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('primerc_edit', array('id' => $primeRC->getId()));
        }

        return $this->render('primerc/edit.html.twig', array(
            'primeRC' => $primeRC,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a primeRC entity.
     *
     */
    public function deleteAction(Request $request, PrimeRC $primeRC)
    {
        $form = $this->createDeleteForm($primeRC);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($primeRC);
            $em->flush();
        }

        return $this->redirectToRoute('primerc_index');
    }

    /**
     * Creates a form to delete a primeRC entity.
     *
     * @param PrimeRC $primeRC The primeRC entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(PrimeRC $primeRC)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('primerc_delete', array('id' => $primeRC->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
