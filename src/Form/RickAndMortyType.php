<?php

namespace App\Form;

use App\Entity\RickAndMorty;
use App\Entity\Locations;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RickAndMortyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', null, [
                "label" => "Nombre",
                "attr" => ["placeholder"=>"Nombra el nuevo personaje "]])
            ->add('status', null, [
                "label" => "Estado",
                "attr" => ["placeholder"=>"Indica el estado -alive, dead, unknown- del nuevo personaje "]])
            ->add('image', null,
            [
                "label" => "Imagen",
                "attr" => ["placeholder"=>"Añade la imagen del nuevo personaje "]])
            ->add('location', EntityType::class, [
                "class"=> Locations::class,
                "choice_label" => "name",
                "multiple" => true,
                "expanded" => true
            ])
->add("Enviar", SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RickAndMorty::class,
        ]);
    }
}
