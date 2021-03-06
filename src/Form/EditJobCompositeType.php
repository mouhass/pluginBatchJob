<?php

namespace App\Form;

use App\Entity\Admin;
use App\Entity\JobComposite;
use App\Entity\JobCron;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditJobCompositeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('codecomposite',TextType::class)
            ->add('name',TextType::class)
            ->add('state',TextType::class)
            ->add('actif',TextType::class)
            ->add('emailadmin',TextType::class)
            ->add('expression',TextType::class)
            ->add('listSousJobs',EntityType::class,['class'=>JobCron::class,'multiple'=>true ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JobComposite::class,
        ]);
    }
}
