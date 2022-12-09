<?php

namespace App\Form;

use App\Entity\JobApplication;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Advertisement;
use App\Entity\User;
use App\Entity\Status;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class JobApplicationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            ->add('AdvertisementId', EntityType::class, [
                'class' => Advertisement::class,
                'choice_label' => 'Title',
                'label' => false,
                'attr' => [
                    'placeholder' => 'Advertisement',
                    'style' => 'display:none',
                ],
                'block_prefix' => '{{item.Title}}',
            ])
            
            ->add('UserId', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'Firstname',
                'label' => false,
                'attr' => [
                    'placeholder' => 'User',
                    'style' => 'display:none'
                ],
                'disabled' => true,
                

            ])
            ->add('StatusId', EntityType::class, [
                'class' => Status::class,
                'choice_label' => 'Label',
                'attr' => [
                    'placeholder' => 'Status',
                    'style' => 'display: none;',
                    
                ],
                'label' => false,

            ])
            ->add('Firstname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Firstname',
                    'autocomplete' => 'off',

                ],
                'label' => 'Firstname',
            ])
            ->add('Lastname', TextType::class, [
                'attr' => [
                    'placeholder' => 'Lastname',
                    'autocomplete' => 'off',

                    
                ],
                'label' => 'Lastname',
            ])
            ->add('Email', TextType::class, [
                'attr' => [
                    'placeholder' => 'example@test.com',
                    'autocomplete' => 'off',

                ],
                'label' => 'Email',
            ])
            ->add('Phone', TextType::class, [
                'attr' => [
                    'placeholder' => 'Phone',
                    'autocomplete' => 'off',

                ],
                'label' => 'Phone',
            ])
            ->add('Message', TextareaType::class, [
                'label' => 'Message',
                'attr' => [
                    'placeholder' => 'Message',
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Save',
                'attr' => [
                    'class' => 'btn btn-primary',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => JobApplication::class,
        ]);
    }
}
