<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Police;
use AppBundle\Entity\Sinistre;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Sinistre controller.
 *
 */
class SinistreController extends Controller
{
    /**
     * Lists all sinistre entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $sinistres = $em->getRepository('AppBundle:Sinistre')->findAll();

        return $this->render('sinistre/index.html.twig', array(
            'sinistres' => $sinistres,
        ));
    }

    /**
     * Creates a new sinistre entity.
     *
     */
    public function newAction(Request $request)
    {
        $sinistre = new Sinistre();
        $form = $this->createForm('AppBundle\Form\SinistreType', $sinistre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            #Metier Manus ::
            if(!empty($sinistre->getCinConducteur())){
             $id_contart=$sinistre->getContrat();
             $police=$em->getRepository(Police::class)->findOneBy(array(
            'id'=>$id_contart
            ));
             $class=$police->getClasse();
             $police->setClasse($class+2);
             $em->persist($police);
            }

            $em->persist($sinistre);
            $em->flush();

            return $this->redirectToRoute('sinistre_show', array('code' => $sinistre->getCode()));
        }

        return $this->render('sinistre/new.html.twig', array(
            'sinistre' => $sinistre,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sinistre entity.
     *
     */
    public function showAction(Sinistre $sinistre)
    {
        $deleteForm = $this->createDeleteForm($sinistre);

        return $this->render('sinistre/show.html.twig', array(
            'sinistre' => $sinistre,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sinistre entity.
     *
     */
    public function editAction(Request $request, Sinistre $sinistre)
    {
        $deleteForm = $this->createDeleteForm($sinistre);
        $editForm = $this->createForm('AppBundle\Form\SinistreType', $sinistre);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sinistre_edit', array('code' => $sinistre->getCode()));
        }

        return $this->render('sinistre/edit.html.twig', array(
            'sinistre' => $sinistre,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a sinistre entity.
     *
     */
    public function deleteAction(Request $request, Sinistre $sinistre)
    {
        $form = $this->createDeleteForm($sinistre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sinistre);
            $em->flush();
        }

        return $this->redirectToRoute('sinistre_index');
    }

    /**
     * Creates a form to delete a sinistre entity.
     *
     * @param Sinistre $sinistre The sinistre entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Sinistre $sinistre)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('sinistre_delete', array('code' => $sinistre->getCode())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
