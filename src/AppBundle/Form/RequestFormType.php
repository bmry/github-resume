<?php
/**
 * Created by PhpStorm.
 * User: Morayo
 * Date: 3/9/2019
 * Time: 2:32 PM
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class RequestFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username','text',array('attr' => [
            'class'=> "form-control"
        ]))
            ->add('repoType', 'choice', array(
                'choices'  => array(
                    'GitHub' => 'GitHub',
                    'BitBucket' => 'BitBucket'),
                'attr' => [
                    'class'=> "form-control"
                ]
                ));
    }
}

