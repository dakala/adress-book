<?php

namespace AddrBookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmailType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'emailAddr',
                TextType::class,
                [
                    'label' => "E-mail",
                    'attr' => [
                        'class' => 'form-control',
                    ],
                ]
            )
            ->add(
                'emailType',
                TextType::class,
                [
                    'label' => "Typ e-maila (praca, dom itd.)",
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
                'data_class' => 'AddrBookBundle\Entity\Email',
            )
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'addrbookbundle_email';
    }


}
