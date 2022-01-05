<?php

namespace App\Form;

use App\Entity\Auteurs;
use App\Entity\Articles;
use App\Entity\Categorie;
use App\Entity\Commentaires;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('contenu')
            ->add('date')
            ->add('resume')
            ->add("categorie",EntityType::class,[
                'class'=>Categorie::class,
                'placeholder'=>'selectionnner une categorie',

                'choice_label'=>'titre',
                /*utiliser un checkbox à choix unique ou multiple
                'multiple'=>true,
                'expanded'=>true,*/
            ])
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image à inserrer'
            ])
            ->add("auteurs",EntityType::class,[
                'class'=>Auteurs::class,
                'placeholder'=>'selectionnner une auteur',

                'choice_label'=>'nom',
                /*utiliser un checkbox à choix unique ou multiple
                'multiple'=>true,*/
                'expanded'=>true,
            ])
            // ->add("Commentaires",EntityType::class,[
            //     'class'=>Commentaires::class,
            //     'placeholder'=>'selectionnner un ou plusieurs commentaires',

            //     'choice_label'=>'nom',
            //     /*utiliser un checkbox à choix unique ou multiple*/
            //     'multiple'=>true,
            //     'expanded'=>true,
            //])
        //
        ->add('status',
        ChoiceType::class,[
            'label' => 'statut' ,
            'choices' => [
                'Publier' => 'Publier',
                'Archiver' => 'Archiver',
                'Dépublier' => 'Dépublier'
            ] ,
            'multiple' => false,
            'expanded' => true,])
            ->add("valider",SubmitType::class)
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Articles::class,
        ]);
    }
}
