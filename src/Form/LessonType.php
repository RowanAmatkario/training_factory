<?php


namespace App\Form;


use App\Entity\Lesson;
use App\Entity\Person;
use App\Entity\Training;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LessonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date', DateType::class )
            ->add('time', TimeType::class )
            ->add('location', TextType::class )
            ->add('training', EntityType::class, [
                'class' => Training::class,
                'choice_label' => 'naam',
            ])
            ->add('person', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'firstname',
            ])
            ->add('Plan les', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Lesson::class,
        ]);
    }
}