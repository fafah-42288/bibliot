<?php

namespace App\Form;

use App\Entity\Classique;
use App\Entity\SousCat;
use App\Repository\CategorieRepository;

use App\Repository\SousCatRepository;
use Doctrine\ORM\Mapping\Entity;
use phpDocumentor\Reflection\Types\Null_;
use phpDocumentor\Reflection\Types\Nullable;
use Symfony\Component\Form\AbstractType;
use App\Repository\ClassiqueRepository;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

// 1. Include Required Namespaces
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Categorie;
use function Sodium\add;

class Classique1Type extends AbstractType
{
    private $em;

    /**
     * The Type requires the EntityManager as argument in the constructor. It is autowired
     * in Symfony 3.
     *
     * @param EntityManagerInterface $em
     */
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    { $builder->add('idCat', EntityType::class, array(
        'class' => 'App\Entity\Categorie',
        'placeholder' => 'select a categorie',
        'required' => true,
        'mapped'=>false
    ))
        ;
 }



    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Classique::class,
        ]);

    }
    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'app_entity_classique';
    }
}