<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TemoinType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('cint',TextType::class,[
            'attr'=>['class'=>"form-control col-md-7 col-xs-12"]
            ])
            ->add('nomt',TextType::class,[
                'attr'=>['class'=>"form-control col-md-7 col-xs-12"]
            ])
            ->add('prenomt',TextType::class,[
                'attr'=>['class'=>"form-control col-md-7 col-xs-12"]
            ])
            ->add('telt',TextType::class,[
                'attr'=>['class'=>"form-control col-md-7 col-xs-12"]
            ])
            ->add('description',TextType::class,[
                'attr'=>['class'=>"form-control col-md-7 col-xs-12"]
            ])
            ->add('sinistre',EntityType::class,array(
                'class'=>'AppBundle\Entity\Sinistre',
                'choice_label'=>'code'
            ));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Temoin'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_temoin';
    }


}
