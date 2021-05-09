<?php

namespace App\Form;

use App\Entity\SousCat;
use Doctrine\ORM\Mapping\Entity;
use phpDocumentor\Reflection\DocBlock\Tags\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SousCatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idSousCat', EntityType::class, array(
                'required' => true,
                'placeholder' => 'Select a City first ...',
                'class' => 'App\Entity\SousCat',
                'mapped'=>false))
        ;


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SousCat::class,
        ]);
    }
    // public function filter(QueryBuilder $queryBuilder, FormInterface $form, array $metadata)
    //{
    //    if (null !== $form->getData()) {
    //        $queryBuilder
    //            ->leftJoin('entity.customer', 'customer')
    //            ->andWhere('customer.country = :country')
    //           ->setParameter('country', $form->getData());
    //   }
    // }

}
