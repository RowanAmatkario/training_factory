<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InstructorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', TextType::class, [
                'label'=>'E-mail',
            ])
            ->add('password')
            ->add('firstname', TextType::class, [
                'label'=>'Voornaam',
            ])
            ->add('lastname', TextType::class, [
                'label'=>'Achternaam',
            ])
            ->add('dateofbirth', BirthdayType::class, [
                'label'=>'Geboortedatum',
            ])
            ->add('gender', TextType::class, [
                'label'=>'Geslacht',
            ])
            ->add('Opslaan', SubmitType::class);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
