<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Gregwar\CaptchaBundle\Type\CaptchaType;

class GarantieComplementaireType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,[
                'attr'=>['class'=>"form-control col-md-7 col-xs-12"]])
            ->add('tarifDeBase',TextType::class,[
                'attr'=>['class'=>"form-control col-md-7 col-xs-12"]])

            ->add('nivFranchise',TextType::class,[
                'attr'=>['class'=>"form-control col-md-7 col-xs-12"]])

            ->add('primeDeBase',TextType::class,[
                'attr'=>['class'=>"form-control col-md-7 col-xs-12"]])

            ->add('surprime',TextType::class,[
                'attr'=>['class'=>"form-control col-md-7 col-xs-12"]])
            ->add('captcha', CaptchaType::class,[
            'attr'=>['class'=>"form-control col-md-7 col-xs-12"]]);


    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\GarantieComplementaire'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_garantiecomplementaire';
    }


}
