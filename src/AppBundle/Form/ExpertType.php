<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExpertType extends AbstractType
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
            ->add('email', TextType::class, array(
                'attr'=>['class'=>'form-control']
            ))
            ->add('cinExp', TextType::class, ['attr' => [
                'class'=>'form-control col-md-7 col-xs-12',
            ]])
            ->add('nomExp' , TextType::class, ['attr' => [
                'class'=>'form-control col-md-7 col-xs-12',
            ]])
            ->add('prenomExp', TextType::class, ['attr' => [
                'class'=>'form-control col-md-7 col-xs-12',
            ]])
            ->add('zoneExp', TextType::class, ['attr' => [
        'class'=>'form-control col-md-7 col-xs-12',
    ]])
            ->add('telExp', TextType::class, ['attr' => [
                'class'=>'form-control col-md-7 col-xs-12',
            ]]);

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Expert'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_expert';
    }


}
