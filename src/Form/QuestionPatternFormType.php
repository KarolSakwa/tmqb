<?php

namespace App\Form;

use App\Entity\QuestionPattern;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionPatternFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('text')
            ->add('url')
            ->add('code')
            ->add('first_record_selector')
            ->add('second_record_selector')
            ->add('third_record_selector')
            ->add('fourth_record_selector')
            ->add('category')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => QuestionPattern::class,
        ]);
    }
}
