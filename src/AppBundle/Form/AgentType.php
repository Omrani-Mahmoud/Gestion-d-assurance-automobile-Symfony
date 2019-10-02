<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array(
                'attr'=>['class'=>'form-control']
            ))
            ->add('cin',TextType::class, array(
                'attr'=>['class'=>'form-control','size'=>'8']
            ))
            ->add('nom',TextType::class, array(
                'attr'=>['class'=>'form-control']
            ))
            ->add('prenom',TextType::class, array(
                'attr'=>['class'=>'form-control']
            ))
            ->add('telephone',TextType::class, array(
                'attr'=>['class'=>'form-control']
            ))
            ->add('adresse',TextType::class, array(
                'attr'=>['class'=>'form-control']
            ))
            ->add('email',EmailType::class, array(
                'attr'=>['class'=>'form-control']
            ))
            ->add('agence',EntityType::class, array(
                'attr'=>['class'=>'form-control'],
                'class'=>'AppBundle\Entity\Agence',
                'choice_label'=>'zone',
                'required'=>false
            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Agent'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_agent';
    }


}
