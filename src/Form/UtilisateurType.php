<?php

namespace App\Form;

use App\Entity\Utilisateurs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Date;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class UtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class)
            ->add('prenom',TextType::class)
            ->add('photo',TextType::class)
             ->add("roles",ChoiceType::class, [
                   "choices" => [
                       "Utilisateur" => "ROLE_USER",
                       "Admin" => "ROLE_ADMIN",
                   ],
                   "expanded" => true,
                   "multiple" => true
             ])
            ->add('datedenaissance',DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('login',TextType::class)
            ->add('password',PasswordType::class)
            ->add('adresse',TextType::class)
            ->add('email',EmailType::class,["attr"=>[
                "placeholder"=>"entrez un email valide"
            ]])
            ->add('envoyer',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateurs::class,
        ]);
    }
}
