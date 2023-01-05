<?php

namespace App\Form;

use App\Entity\Fournisseur;
use App\Entity\UserDepense;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DepenseFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('montant', NumberType::class, [
                'attr' => ['class' => 'relative block w-full appearance-none rounded-none rounded-b-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm'],
                'label'=> 'Montant',
            ])
            ->add('engagement', RadioType::class,)
            ->add('datedeprelevement', DateType::class,)
            ->add('datefinengagement', DateType::class,)
            ->add('commentaire', TextareaType::class,)
            ->add('frequence', ChoiceType::class, [
                'choices' => [
                    'Selection' => [
                        'Mensuel' => 'Mensuel',
                        'Annuel' => 'Annuel',
                    ],
                ],
            ])

            ->add('fournisseur', EntityType::class, options:[
                'class' => Fournisseur::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserDepense::class,
        ]);
    }
}
