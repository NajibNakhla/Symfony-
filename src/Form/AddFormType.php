<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Code', TextType::class)
            ->add('Category', ChoiceType::class, [
                'choices' => [
                    'Lave-linge' => 'lave-linge',
                    'Lave-vaisselle' => 'lave-vaisselle',
                    'Réfrigérateur' => 'réfrigérateur',
                    'Congélateur' => 'congélateur',
                ],
                'placeholder' => 'Sélectionnez une catégorie', // Optional placeholder
            ])
            ->add('EconomyRating', TextType::class)
            ->add('Manufacture', ChoiceType::class, [
                'choices' => [
                    'Bakou' => 'Bakou',
                    'ABC' => 'ABC',
                ],
                'expanded' => true, // Render as radio buttons
                'multiple' => false, // Only one option can be selected
            ])
            ->add('Price', MoneyType::class)
            ->add('FabricationDate', DateType::class)
            ->add('Stock', IntegerType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'App\Entity\APPLIANCE', // Update with your entity class
        ]);
    }
}