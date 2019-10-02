<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PoliceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date_effet_police', DateType::class, [
            'attr'=>['class'=>"form-control col-md-7 col-xs-12 js-datepicker-effet"],
            'widget'=>'single_text',
            'html5'=>false,
        ])
            ->add('dateEcheance', DateType::class, [
                'attr'=>['class'=>"form-control col-md-7 col-xs-12 js-datepicker"],
                'widget'=>'single_text',
                'html5'=>false
            ])
            ->add('statut', TextType::class, ['attr'=>[
                'class'=>'form-control col-md-7 col-xs-12'
            ]])
            ->add('montant', TextType::class, ['attr'=>[
                'class'=>'form-control col-md-7 col-xs-12'
            ]])
            ->add('classe', TextType::class, ['attr'=>[
                'class'=>'form-control col-md-7 col-xs-12'
            ]])
            ->add('usageContrat', TextType::class, ['attr'=>[
                'class'=>'form-control col-md-7 col-xs-12'
            ]])
            ->add('codeAssure',EntityType::class, array(
                'attr'=>['class'=>'form-control'],
                'class'=>'AppBundle\Entity\Assure',
                'choice_label'=>'cin',
                'multiple'=>false,
                'required'=>false
            ))
            ->add('vehicules',EntityType::class, array(
                'attr'=>['class'=>'form-control'],
                'class'=>'AppBundle\Entity\Vehicule',
                'choice_label'=>'chassis',
                'multiple'=>true,
                'required'=>false
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
            'data_class' => 'AppBundle\Entity\Police'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_police';
    }


}
