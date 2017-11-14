<?php

namespace AddrBookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PhoneType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'phoneNum',
                TextType::class,
                [
                    'label' => "Numer telefonu",
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ]
            )
            ->add(
                'PhoneType',
                TextType::class,
                [
                    'label' => "Typ numeru telefonu (praca, dom itd.)",
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
                'data_class' => 'AddrBookBundle\Entity\Phone',
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'addrbookbundle_phone';
    }
}
