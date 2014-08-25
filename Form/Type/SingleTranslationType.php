<?php
/**
 * Created by PhpStorm.
 * User: nicolosinger
 * Date: 24.08.14
 * Time: 20:05
 */

namespace TX3\DoctrineUtilBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SingleTranslationType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $attr = array('class' => 'form-control');
        $builder->add('content', 'text', array(
            'label' => false,
            'required' => false,
            'attr' => $attr,
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Tuxes3\Bundle\DoctrineUtilBundle\Entity\Translation'
        ));
    }

    public function getName()
    {
        return 'SingleTranslationType';
    }

} 