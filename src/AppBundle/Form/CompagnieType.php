<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotNull;

class CompagnieType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array(
                'attr'=>['class'=>'form-control col-md-7 col-xs-12']
            ))
            ->add('email', TextType::class, array(
                'attr'=>['class'=>'form-control col-md-7 col-xs-12'],
                'label'=>'Email Responsable'
            ))
            ->add('nomCompagnie', TextType::class, ['attr'=>[
                    'class'=>'form-control col-md-7 col-xs-12'
            ]])
            ->add('adresse', TextType::class, ['attr'=>['class'=>'form-control col-md-7 col-xs-12']])
            ->add('fixe',TextType::class, ['attr'=>['class'=>'form-control col-md-7 col-xs-12']])
            ->add('fax',TextType::class, ['attr'=>['class'=>'form-control col-md-7 col-xs-12']])
            ->add('site',TextType::class, ['attr'=>['class'=>'form-control col-md-7 col-xs-12']])
            ->add('enabled', HiddenType::class, array(
                'empty_data'=>true
            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Compagnie'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_compagnie';
    }


}
