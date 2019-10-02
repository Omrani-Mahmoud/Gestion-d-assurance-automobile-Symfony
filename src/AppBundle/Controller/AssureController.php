<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Assure;
use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Assure controller.
 *
 */
class AssureController extends Controller
{
    /**
     * Lists all assure entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $assures = $em->getRepository(Assure::class)->findAll();
        return $this->render('assure/index.html.twig', array(
            'assures' => $assures,
        ));
    }

    /**
     * Creates a new assure entity.
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $assure = new Assure();
        $encoded = $encoder->encodePassword($assure, '12345');
        $assure->setPassword($encoded);
        $assure->setRoles(['ROLE_ASSURE']);
        $form = $this->createForm('AppBundle\Form\AssureType', $assure);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($assure);
            $em->flush();
            return $this->redirectToRoute('assure_show', array('id' => $assure->getId()));
        }

        return $this->render('assure/new.html.twig', array(
            'assure' => $assure,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a assure entity.
     * @param Assure $assure
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Assure $assure)
    {
        $deleteForm = $this->createDeleteForm($assure);
        return $this->render('assure/show.html.twig', array(
            'assure' => $assure,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing assure entity.
     * @param Request $request
     * @param Assure $assure
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Assure $assure)
    {
        $deleteForm = $this->createDeleteForm($assure);
        $editForm = $this->createForm('AppBundle\Form\AssureType', $assure);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('assure_edit', array('id' => $assure->getId()));
        }
        return $this->render('assure/edit.html.twig', array(
            'assure' => $assure,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a assure entity.
     * @param Request $request
     * @param Assure $assure
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request)
    {
        $id = $request->get('id');
        $em = $this->getDoctrine()->getManager();
        $assure = $em->getRepository('AppBundle:Assure')->find($id);
        $em->remove($assure);
        $em->flush();
        return $this->redirectToRoute('assure_index');
    }

    /**
     * Creates a form to delete a assure entity.
     *
     * @param Assure $assure The assure entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(Assure $assure)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('assure_delete', array('id' => $assure->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
