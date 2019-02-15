<?php

namespace App\Http\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;

class ActivityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('date', DateTimeType::class, [
            'format' => "yyyy-MM-dd'T'HH:mm:ssZZZZZ",
            'widget' => 'single_text',
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ActivityDto::class,
            'csrf_protection'    => false,
            'allow_extra_fields' => true,
        ]);
    }
}
