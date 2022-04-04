<?php

namespace App\Form\Type;


use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

class JobCronType extends AbstractType
{

    public function  buildForm(FormBuilderInterface $builder, array $options)
    { $builder
        ->add('name',TextType::class, ['required'=>false])
        ->add('expression', TextType::class,['required'=>false])
        ->add("state",TextType::class,['required'=>false])
        ->add("actif", TextType::class, ['required'=>false])
        ->add('nextDateExec', DateTimeType::class,['required'=>false])
        ->add('scriptExec',TextType::class,['required'=>false]);

    }

}
