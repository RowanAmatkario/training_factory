<?php


namespace App\Form;


use App\Entity\Person;
use App\Entity\Training;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('loginname', TextType::class )
            ->add('password', TextType::class)
            ->add('firstname', TextType::class)
            ->add('preprovision', TextType::class)
            ->add('lastname', TextType::class)
            ->add('dateofbirth', BirthdayType::class)
            ->add('gender', ChoiceType::class, array(
                'choices' => array(
                    'Man' => 'Man',
                    'Vrouw' => 'Vrouw',
                    'Geen' => 'Geen',
                )
            ))
            ->add('emailaddress', TextType::class)
            ->add('Registeren', SubmitType::class);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Person::class,
        ]);
    }
}