<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Tests\Extension\Core\Type\DateTypeTest;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\DateTime;

class SinistreType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateSinistre',DateTimeType::class, [
                'attr'=>['class'=>"form-control col-md-7 col-xs-12 js-datepicker"],
                'widget'=>'single_text',
                'html5'=>false,
            ])
            ->add('lieuSinistre',TextType::class, ['attr'=>['class'=>"form-control col-md-7 col-xs-12"]])
            ->add('dommageCorps',TextType::class, ['attr'=>['class'=>"form-control col-md-7 col-xs-12"]])
            ->add('cin_conducteur',TextType::class, ['attr'=>['class'=>"form-control col-md-7 col-xs-12"],
            'required'=>false])
            ->add('dommageMateriel',TextType::class, ['attr'=>['class'=>"form-control col-md-7 col-xs-12"]])
            ->add('contrat',EntityType::class, array(
                'attr'=>['class'=>'form-control'],
                'class'=>'AppBundle\Entity\Police',
                'choice_label'=>'id',
                'required'=>false
            ))
            ->add('vehicule',EntityType::class, array(
                'attr'=>['class'=>'form-control'],
                'class'=>'AppBundle\Entity\Vehicule',
                'choice_label'=>'chassis',
                'required'=>false
            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Sinistre'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_sinistre';
    }


}
