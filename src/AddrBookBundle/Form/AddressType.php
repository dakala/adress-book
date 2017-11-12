<?php

namespace AddrBookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'city',
                TextType::class,
                [
                    'label' => "Miasto",
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ]
            )
            ->add(
                'street',
                TextType::class,
                [
                    'label' => "Ulica",
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ]
            )
            ->add(
                'houseNum',
                TextType::class,
                [
                    'label' => "Numer Domu",
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ]
            )
            ->add(
                'flatNum',
                TextType::class,
                [
                    'label' => "Numer mieszkania",
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ]
            )
            ->add(
                "submit",
                SubmitType::class,
                [
                    "label" => "Zapisz",

                    'attr' => [
                        'class' => 'top-marg btn',
                    ],
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'AddrBookBundle\Entity\Address',
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'addrbookbundle_address';
    }


}
