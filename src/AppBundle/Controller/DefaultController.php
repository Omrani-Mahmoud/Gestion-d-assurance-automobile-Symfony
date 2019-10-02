<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Admin;
use AppBundle\Entity\Agence;
use AppBundle\Entity\Agent;
use AppBundle\Entity\Assure;
use AppBundle\Entity\Compagnie;
use AppBundle\Entity\Courtier;
use AppBundle\Entity\Expert;
use AppBundle\Entity\User;
use Mremi\ContactBundle\Form\Type\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request, UserPasswordEncoderInterface $encoder)
    {
        $em = $this->getDoctrine()->getManager();
        $admin = $em->getRepository(Admin::class)->getAdmins();
        if(!$admin){
            $admin = new Admin('admin','admin@gmail.com','ROLE_SUPER_ADMIN');
            $encoded = $encoder->encodePassword($admin,'12345');

            $admin->setPassword($encoded);
            $admin->setEnabled(true);
            $em->persist($admin);
            $em->flush();
        }
        if ($this->getUser()) {
            if(is_a($this->getUser(),Admin::class,false)){
                return $this->redirectToRoute('compagnie_index');
            }
            if(is_a($this->getUser(),Compagnie::class,false)){
                return $this->redirectToRoute('gestion_compagnie_home');
            }
            if(is_a($this->getUser(),Agent::class,false)){
                return $this->redirectToRoute('gestion_agence_homepage');
            }

            if(is_a($this->getUser(),Assure::class,false)){
                return $this->redirectToRoute('assure_Profile');
            }

            if(is_a($this->getUser(),Expert::class,false)){
                return $this->redirectToRoute('gestion_expert_reclamation');
            }

            if(is_a($this->getUser(),Courtier::class,false)){
                return $this->redirectToRoute('gestion_courtier_homepage');
            }
            return $this->redirectToRoute('fos_user_security_login');
        } else {
            $form = $this->createForm(ContactType::class);
            return $this->render('indiv.html.twig',
                array('form'=>$form->createView())
        );
        }
    }

    public function contactAction()
    {
        $form = $this->createForm(ContactType::class);
        return $this->render('contact.html.twig', array(
           'form'=>$form->createView()
        ));
    }}
