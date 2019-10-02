<?php

namespace AppBundle\Form;

use AppBundle\Entity\Police;
use AppBundle\Entity\PrimeRC;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
class VehiculeType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('chassis',TextType::class,[
            'attr' => ['class' =>"form-control col-md-7 col-xs-12"]])

            ->add('ref_contrat',EntityType::class, array(
                'attr'=>['class'=>'form-control'],
                'class'=>Police::class,
                'choice_label'=>'id',
                'required'=>true))

            ->add('dateCircule',DateTimeType::class, [
                'attr'=>['class'=>"form-control col-md-7 col-xs-12 js-datepicker"],
                'widget'=>'single_text',
                'html5'=>false,
            ])
            ->add('puissance',TextType::class,[
                'attr' => ['class' =>"form-control col-md-7 col-xs-12"]])
            ->add('carburant',TextType::class,[
                'attr' => ['class' =>"form-control col-md-7 col-xs-12"]])
            ->add('nombrePneu',TextType::class,[
                'attr' => ['class' =>"form-control col-md-7 col-xs-12"]])
            ->add('valVenale',TextType::class,[
                'attr' => ['class' =>"form-control col-md-7 col-xs-12"]])
            ->add('primeRC',EntityType::class, array(
                'attr'=>['class'=>'form-control'],
                'class'=>PrimeRC::class,
                'choice_label'=>'id',
                'required'=>true));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Vehicule'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_vehicule';
    }


}
