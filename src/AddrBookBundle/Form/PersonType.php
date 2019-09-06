<?php

namespace AddrBookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'label' => "Imię",
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ]
            )
            ->add(
                'surname',
                TextType::class,
                [
                    'label' => "Nazwisko",
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ]
            )
            ->add(
                'description',
                TextType::class,
                [
                    'label' => "Opis",
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
                        'class' => 'top-marg btn btn-primary',
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
                'data_class' => 'AddrBookBundle\Entity\Person',
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'addrbookbundle_person';
    }


}
