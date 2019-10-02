<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Constat;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Constat controller.
 *
 */
class ConstatController extends Controller
{
    /**
     * Lists all constat entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $constats = $em->getRepository('AppBundle:Constat')->findAll();
        return $this->render('constat/index.html.twig', array(
            'constats' => $constats,
        ));
    }

    /**
     * Creates a new constat entity.
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $constat = new Constat();
        $form = $this->createForm('AppBundle\Form\ConstatType', $constat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($constat);
            $em->flush();
            return $this->redirectToRoute('constat_show', array('codeRec' => $constat->getCodeRec()));
        }
        return $this->render('constat/new.html.twig', array(
            'constat' => $constat,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a constat entity.
     * @param Constat $constat
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Constat $constat)
    {
        $deleteForm = $this->createDeleteForm($constat);
        return $this->render('constat/show.html.twig', array(
            'constat' => $constat,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing constat entity.
     * @param Request $request
     * @param Constat $constat
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Constat $constat)
    {
        $deleteForm = $this->createDeleteForm($constat);
        $editForm = $this->createForm('AppBundle\Form\ConstatType', $constat);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('constat_edit', array('codeRec' => $constat->getCodeRec()));
        }
        return $this->render('constat/edit.html.twig', array(
            'constat' => $constat,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a constat entity.
     *
     */
    public function deleteAction(Request $request, Constat $constat)
    {
        //$id = $request->get('');
        $em = $this->getDoctrine()->getManager();
        //$constat = $em->getRepository('AppBundle:Constat')->find($id);
        $em->remove($constat);
        $em->flush();

        return $this->redirectToRoute('constat_index');
    }

    /**
     * Creates a form to delete a constat entity.
     *
     * @param Constat $constat The constat entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(Constat $constat)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('constat_delete', array('codeRec' => $constat->getCodeRec())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
