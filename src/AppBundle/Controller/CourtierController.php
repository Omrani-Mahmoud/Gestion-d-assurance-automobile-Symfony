<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Courtier;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Courtier controller.
 *
 */
class CourtierController extends Controller
{
    /**
     * Lists all courtier entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $courtiers = $em->getRepository('AppBundle:Courtier')->findAll();

        return $this->render('courtier/index.html.twig', array(
            'courtiers' => $courtiers,
        ));
    }

    /**
     * Creates a new courtier entity.
     *
     */
    public function newAction(Request $request,UserPasswordEncoderInterface $encoder)
    {
        $courtier = new Courtier(null, null, 'ROLE_COURTIER' );
        $encoded = $encoder->encodePassword($courtier, '12345');
        $courtier->setPassword($encoded);
        $form = $this->createForm('AppBundle\Form\CourtierType', $courtier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($courtier);
            $em->flush();

            return $this->redirectToRoute('courtier_show', array('id' => $courtier->getId()));
        }

        return $this->render('courtier/new.html.twig', array(
            'courtier' => $courtier,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a courtier entity.
     *
     */
    public function showAction(Courtier $courtier)
    {
        $deleteForm = $this->createDeleteForm($courtier);

        return $this->render('courtier/show.html.twig', array(
            'courtier' => $courtier,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing courtier entity.
     *
     */
    public function editAction(Request $request, Courtier $courtier)
    {
        $deleteForm = $this->createDeleteForm($courtier);
        $editForm = $this->createForm('AppBundle\Form\CourtierType', $courtier);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('courtier_edit', array('id' => $courtier->getId()));
        }

        return $this->render('courtier/edit.html.twig', array(
            'courtier' => $courtier,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a courtier entity.
     *
     */
    public function deleteAction(Request $request, Courtier $courtier)
    {
        $form = $this->createDeleteForm($courtier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($courtier);
            $em->flush();
        }

        return $this->redirectToRoute('courtier_index');
    }

    /**
     * Creates a form to delete a courtier entity.
     *
     * @param Courtier $courtier The courtier entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Courtier $courtier)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('courtier_delete', array('id' => $courtier->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
