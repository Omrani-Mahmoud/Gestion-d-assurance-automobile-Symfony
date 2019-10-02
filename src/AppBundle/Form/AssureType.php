<?php namespace AppBundle\Form;

//use function PHPSTORM_META\type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssureType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, array('attr'=>['class'=>'form-control']))
            ->add('email', TextType::class, array('attr'=>['class'=>'form-control']))
            ->add('cin', TextType::class, array('attr'=>['class'=>'form-control']))
            ->add('raison_social', TextType::class, array('attr'=>['class'=>'form-control']))
            ->add('responsable_societe', TextType::class, array('attr'=>['class'=>'form-control']))
            ->add('nom', TextType::class, array('attr'=>['class'=>'form-control']))
            ->add('prenom', TextType::class, array('attr'=>['class'=>'form-control']))
            ->add('adresse', TextType::class, array('attr'=>['class'=>'form-control']))
            ->add('email', TextType::class, array('attr'=>['class'=>'form-control']))
            ->add('tel', TextType::class, array('attr'=>['class'=>'form-control']))
            ->add('fax', TextType::class, array('attr'=>['class'=>'form-control']))
            ->add('profession', TextType::class, array('attr'=>['class'=>'form-control']))
            ->add('dateEnreg', DateType::class, array('attr'=>['class'=>'form-control']))
            ->add('enabled', HiddenType::class, array('empty_data' => 'true'));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Assure'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_assure';
    }
}
