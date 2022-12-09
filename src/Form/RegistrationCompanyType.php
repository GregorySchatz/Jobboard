<?php

namespace App\Form;

use App\Entity\Company;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class RegistrationCompanyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('Firstname', TextType::class, [
            'attr' => [
                'class' => 'form-control',
            ],
            'label' => 'Firstname',
            'label_attr' => [
                'class' => 'form-label' 
            ],
            'constraints' => [
                new Assert\NotBlank()
            ]
        ])
        ->add('Lastname', TextType::class, [
            'attr' => [
                'class' => 'form-control',
            ],
            'label' => 'Lastname',
            'label_attr' => [
                'class' => 'form-label' 
            ],
            'constraints' => [
                new Assert\NotBlank()
            ]
        ])
        ->add('Email', EmailType::class, [
            'attr' => [
                'class' => 'form-control',
            ],
            'label' => 'Email',
            'label_attr' => [
                'class' => 'form-label' 
            ],
            'constraints' => [
                new Assert\NotBlank(),
                new Assert\Email()
            ]
        ])
        ->add('Phone', TelType::class, [
            'attr' => [
                'class' => 'form-control',
            ],
            'label' => 'Phone',
            'label_attr' => [
                'class' => 'form-label' 
            ],
            'constraints' => [
                new Assert\NotBlank()
            ]
        ])
        ->add('CompanyId', EntityType::class, [
            'class' => Company::class,
            'choice_label' => 'Name',
            'attr' => [
                'placeholder' => 'Company',
            ],          
        ])
        ->add('plainPassword', RepeatedType::class, [
            'type' => PasswordType::class,
            'first_options' => [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Password',
                'label_attr' => [
                    'class' => 'form-label' 
                ]
            ],
            'second_options' => [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Confirm Password',
                'label_attr' => [
                    'class' => 'form-label' 
                ]
            ],
            'invalid_message' => "Password doesn't matching"
        ])
        ->add('submit', SubmitType::class, [
            'attr' => [
                'class' => 'btn btn-primary mt-4'
            ]
        ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
