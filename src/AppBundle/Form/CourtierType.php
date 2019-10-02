<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CourtierType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('username', TextType::class, ['attr' => [
            'class'=>'form-control col-md-7 col-xs-12',
        ]])
            ->add('nom', TextType::class, ['attr' => [
            'class'=>'form-control col-md-7 col-xs-12',
        ]])
            ->add('lieu', TextType::class, ['attr' => [
                'class'=>'form-control col-md-7 col-xs-12',
            ]])
            ->add('commission', TextType::class, ['attr' => [
                'class'=>'form-control col-md-7 col-xs-12',
            ]])
            ->add('username', TextType::class, array(
                'attr'=>['class'=>'form-control']
            ))
             ->add('email', TextType::class, array(
                 'attr'=>['class'=>'form-control']
                ))
            ->add('enabled', HiddenType::class, array(
                'attr'=>['class'=>'form-control'],
                'empty_data'=>true
            ));

    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Courtier'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_courtier';
    }


}
