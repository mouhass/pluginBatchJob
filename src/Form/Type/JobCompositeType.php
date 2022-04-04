<?php


namespace App\Form\Type;


use App\Entity\Job;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;


use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;


class JobCompositeType extends AbstractType
{

    public function  buildForm(FormBuilderInterface $builder, array $options)
    { $builder
        ->add('name',TextType::class, ['required'=>false])
        ->add('expression', TextType::class,['required'=>false])
        ->add("state",TextType::class,['required'=>false])
        ->add('actif', NumberType::class, ['required'=>false])
        ->add('nextDateExec', DateTimeType::class,['required'=>false]);

    }

}
