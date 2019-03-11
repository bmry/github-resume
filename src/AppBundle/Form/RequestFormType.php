<?php
/**
 * Created by PhpStorm.
 * User: Morayo
 * Date: 3/9/2019
 * Time: 2:32 PM
 */

namespace AppBundle\Form;


use AppBundle\Validation\Constraints\RepoAccount;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RequestFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username','text',array('label' => 'form.label.username','attr' => [
            'class'=> "form-control"
        ]))
            ->add('repoType', 'choice', array(
                'label' => 'form.label.repository_type',
                'choices'  => array(
                    'GitHub' => 'GitHub',
                    'BitBucket' => 'BitBucket'),
                'attr' => [
                    'class'=> "form-control"
                ]
                ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'cascade_validation' => true,
            'constraints' => [new  RepoAccount()],
        ));
    }
    public function getName()
    {
        return 'appbundle_resume';
    }
}

