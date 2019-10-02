<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Compagnie;
use AppBundle\Entity\User;
use FOS\UserBundle\Doctrine\UserManager;
use FOS\UserBundle\FOSUserBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Compagnie controller.
 *
 */
class CompagnieController extends Controller
{
    /**
     * Lists all compagnie entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $compagnies = $em->getRepository('AppBundle:Compagnie')->findAll();

        return $this->render('compagnie/index.html.twig', array(
            'compagnies' => $compagnies,
        ));
    }

    /**
     * Creates a new compagnie entity.
     *
     */
    public function newAction(Request $request,UserPasswordEncoderInterface $encoder)
    {
        $compagnie = new Compagnie(null, null, null);
        $encoded = $encoder->encodePassword($compagnie, '12345');
        $compagnie->setPassword($encoded);
        $compagnie->setRoles(['ROLE_COMPAGNIE']);
        $form = $this->createForm('AppBundle\Form\CompagnieType', $compagnie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($compagnie);
            $em->flush();
            return $this->redirectToRoute('compagnie_show', array('id' => $compagnie->getId()));
        }

        return $this->render('compagnie/new.html.twig', array(
            'compagnie' => $compagnie,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a compagnie entity.
     *
     */
    public function showAction(Compagnie $compagnie)
    {
        $deleteForm = $this->createDeleteForm($compagnie);

        return $this->render('compagnie/show.html.twig', array(
            'compagnie' => $compagnie,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing compagnie entity.
     *
     */
    public function editAction(Request $request, Compagnie $compagnie)
    {
        $deleteForm = $this->createDeleteForm($compagnie);
        $editForm = $this->createForm('AppBundle\Form\CompagnieType', $compagnie);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('compagnie_edit', array('id' => $compagnie->getId()));
        }

        return $this->render('compagnie/edit.html.twig', array(
            'compagnie' => $compagnie,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a compagnie entity.
     *
     */
    public function deleteAction(Request $request, Compagnie $compagnie)
    {
        $form = $this->createDeleteForm($compagnie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($compagnie);
            $em->flush();
        }

        return $this->redirectToRoute('compagnie_index');
    }

    /**
     * Creates a form to delete a compagnie entity.
     *
     * @param Compagnie $compagnie The compagnie entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Compagnie $compagnie)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('compagnie_delete', array('id' => $compagnie->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


}
