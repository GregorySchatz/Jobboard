<?php

namespace App\Form;

use App\Entity\Advertisement;
use App\Entity\Company;
use App\Entity\TypeContract;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateAdvertisementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('CompanyId', EntityType::class, [
                'class' => Company::class,
                'choice_label' => 'Name',
                'label' => false,
                'disabled' => true,
                'attr' => [
                    'class' => 'form-control',
                    'style' => 'display:none'
                ],
                'label_attr' => [
                    'class' => 'form-label' 
                ],

            ])

            ->add('TypeContractId', EntityType::class, [
                'class' => TypeContract::class,
                'choice_label' => 'Label',
                'label' => "Contract's type",
                'attr' => [
                    'class' => 'form-control',
                ],
                'label_attr' => [
                    'class' => 'form-label' 
                ],
            ])

            ->add('Title', TextType::class, [
                'attr' => [
                    'placeholder' => 'Title of the job',
                    'autocomplete' => 'off',
                    'class' => 'form-control',
                ],
                'label' => 'Title',
                'label_attr' => [
                    'class' => 'form-label' 
                ],
            ])

            ->add('Description', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Description of the job',
                    'autocomplete' => 'off',
                    'class' => 'form-control',
                ],
                'label' => 'Description',
                'label_attr' => [
                    'class' => 'form-label' 
                ],
            ])
            ->add('Wages', IntegerType::class, [
                'attr' => [
                    'placeholder' => '€',
                    'autocomplete' => 'off',
                    'class' => 'form-control',
                ],
                'label' => 'Wages',
                'label_attr' => [
                    'class' => 'form-label' 
                ],
            ])
            ->add('Workingtime', IntegerType::class, [
                'attr' => [
                    'placeholder' => 'Hours',
                    'autocomplete' => 'off',
                    'class' => 'form-control',
                ],
                'label' => 'Working time',
                'label_attr' => [
                    'class' => 'form-label' 
                ],
            ])


            ->add('save', SubmitType::class, [
                'label' => 'Save',
                'attr' => [
                    'class' => 'btn bcgColorBlue form-control',
                    
                ],
               
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Advertisement::class,
        ]);
    }
}
