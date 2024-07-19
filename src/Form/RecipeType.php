<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Recipe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => ['class' => 'input input-bordered w-full'],
                'row_attr' => ['class' => 'mb-10']
            ])
            ->add('description', TextareaType::class, [
                'attr' => ['class' => 'textarea textarea-bordered w-full'],
                'row_attr' => ['class' => 'mb-10']
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'attr' => ['class' => 'select select-bordered w-full'],
                'row_attr' => ['class' => 'mb-10']
            ])
            ->add('ingredients', CollectionType::class, [
                'entry_type' => IngredientType::class,
                'prototype' => true,
                'allow_add' => true,
                'allow_extra_fields' => true,
                'entry_options' => ['label' => false],
                'by_reference' => false
            ])
            ->add('steps', CollectionType::class, [
                'entry_type' => StepType::class,
                'prototype' => true,
                'allow_add' => true,
                'allow_extra_fields' => true,
                'entry_options' => ['label' => false],
                'by_reference' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
