<?php

namespace AppBundle\Form;

use Gregwar\CaptchaBundle\Type\CaptchaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AgenceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('zone', TextType::class, ['attr'=>[
            'class'=>'form-control col-md-7 col-xs-12'
        ]])
            ->add('telephone', TextType::class, ['attr'=>[
                'class'=>'form-control col-md-7 col-xs-12'
            ]])
            ->add('nbrEmployer', TextType::class, ['attr'=>[
                'class'=>'form-control col-md-7 col-xs-12'
            ]])
            ->add('fax', TextType::class, ['attr'=>[
                'class'=>'form-control col-md-7 col-xs-12'
            ]])
            ->add('captcha', CaptchaType::class,[
        'attr'=>['class'=>"form-control col-md-7 col-xs-12"]]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Agence'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_agence';
    }


}
