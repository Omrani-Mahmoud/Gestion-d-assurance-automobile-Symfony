<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Expert;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Expert controller.
 *
 */
class ExpertController extends Controller
{
    /**
     * Lists all expert entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $experts = $em->getRepository('AppBundle:Expert')->findAll();

        return $this->render('expert/index.html.twig', array(
            'experts' => $experts,
        ));
    }

    /**
     * Creates a new expert entity.
     *
     */
    public function newAction(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $expert = new Expert(null, null, null);
        $encoded = $encoder->encodePassword($expert, '12345');
        $expert->setPassword($encoded);
        $form = $this->createForm('AppBundle\Form\ExpertType', $expert);
        $form->handleRequest($request);
        $expert->setRoles(['ROLE_EXPERT']);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($expert);
            $em->flush();

            return $this->redirectToRoute('expert_show', array('cinExp' => $expert->getCinExp()));
        }

        return $this->render('expert/new.html.twig', array(
            'expert' => $expert,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a expert entity.
     *
     */
    public function showAction(Expert $expert)
    {
        $deleteForm = $this->createDeleteForm($expert);

        return $this->render('expert/show.html.twig', array(
            'expert' => $expert,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing expert entity.
     *
     */
    public function editAction(Request $request, Expert $expert)
    {
        $deleteForm = $this->createDeleteForm($expert);
        $editForm = $this->createForm('AppBundle\Form\ExpertType', $expert);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('expert_edit', array('cinExp' => $expert->getCinexp()));
        }

        return $this->render('expert/edit.html.twig', array(
            'expert' => $expert,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a expert entity.
     *
     */
    public function deleteAction(Request $request, Expert $expert)
    {
        $form = $this->createDeleteForm($expert);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($expert);
            $em->flush();
        }

        return $this->redirectToRoute('expert_index');
    }

    /**
     * Creates a form to delete a expert entity.
     *
     * @param Expert $expert The expert entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Expert $expert)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('expert_delete', array('cinExp' => $expert->getCinexp())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
