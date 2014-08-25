<?php
/**
 * Created by PhpStorm.
 * User: nicolosinger
 * Date: 24.08.14
 * Time: 17:00
 */

namespace TX3\DoctrineUtilBundle\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormView;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TranslationType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'expanded' => false,
            'multiple' => true,
            'type' => new SingleTranslationType(),
        ));
    }

    public function getParent()
    {
        return 'collection';
    }

    public function getName()
    {
        return 'translation';
    }
} 