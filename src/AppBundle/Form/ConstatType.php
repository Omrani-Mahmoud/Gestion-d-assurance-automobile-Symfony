<?php

namespace AppBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConstatType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateRec', DateType::class, ['attr' => ['class' => 'form-control col-md7 col-xs-12']])
            ->add('lieuRec', TextType::class, ['attr' => ['class' => 'form-control col-md7 col-xs-12']])
            ->add('objetRec', TextType::class, ['attr' => ['class' => 'form-control col-md7 col-xs-12']])
            ->add('commentaireRec', TextType::class, ['attr' => ['class' => 'form-control col-md7 col-xs-12']])
            ->add('codeSinistre', EntityType::class, array(
                'attr' => ['class' => 'form-control'],
                'class' => 'AppBundle\Entity\Sinistre',
                'choice_label' => 'cin_conducteur',
                'required' => false
            ))
            //->add('rapport', TextType::class, ['attr' => ['class' => 'form-control col-md7 col-xs-12']])
            ->add('croquis', TextType::class, ['attr' => ['class' => 'form-control col-md7 col-xs-12']])
            ->add('matriculeAutrui', TextType::class, ['attr' => ['class' => 'form-control col-md7 col-xs-12']]);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Constat'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_constat';
    }

}
