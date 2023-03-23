<?php

namespace App\Form;

use App\Entity\Order;
use Doctrine\DBAL\Types\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PizzaFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('naam',TextType::class)
            ->add('adres',TextType::class)
            ->add('nummer', NumberType::class)
            ->add('email', TextType::class)
            ->add('size',ChoiceType::class,[
                'choices'=> [
                'medium'=>'medium',
                'large'=>'large',
                'calzone'=>'calzone'

            ]
    ])

            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Order::class,
        ]);
    }
}
