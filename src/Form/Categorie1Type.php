<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\SousCat;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Categorie1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numCat')
            ->add('libelleCat', EntityType::class, array(
                'class' => 'App\Entity\SousCat',
                'placeholder' => 'select a categorie',
                'required' => true,
                'mapped'=>false
            ));
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Categorie::class,
        ]);
    }
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_entity_categorie';
    }
}
