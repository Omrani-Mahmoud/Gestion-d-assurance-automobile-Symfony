<?php

namespace Gestion\ExpertBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class RapportType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titreRap', TextType::class, ['attr' => ['class' => 'form-control col-md-7 col-xs-12']])
            ->add('detailleRap', TextType::class, ['attr' => ['class' => 'form-control col-md-7 col-xs-12']])
            ->add('documentRap', VichFileType::class)
            ->add('dateRap', DateType::class, [
                'attr' => ['class' => "form-control col-md-7 col-xs-12 js-datepicker"],
                'widget' => 'single_text',
                'html5' => false,
            ])
            ->add('tempRap', TimeType::class, [
                'attr' => ['class' => "form-control col-md-7 col-xs-12 js-timepicker"],
                'widget' => 'single_text',
                'html5' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Reclamation'
        ));
    }

    public function getBlockPrefix()
    {
        return 'gestion_expert_bundle_rapport';
    }
}
