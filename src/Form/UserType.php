<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', null, [
                "label" => "Nombre de usuario",
                "attr" => ["placeholder"=>"Añade tu nombre de usuario"]])
         //   ->add('roles')
            ->add('password', PasswordType::class, [
                "label" => "Contraseña",
                "attr" => ["placeholder"=>"Añade tu contraseña"]])
            ->add('name', null, [
                "label" => "Nombre",
                "attr" => ["placeholder"=>"Añade tu nombre"]])
            ->add("Enviar", SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
