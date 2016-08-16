<?php

namespace AppBundle\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class SpotType extends AbstractResourceType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description', TextareaType::class, [
                'required' => false,
            ])
            ->add('lat', NumberType::class, [
                'required' => false,
            ])
            ->add('lng', NumberType::class, [
                'required' => false,
            ])
            ->add('country', TextType::class, [
                'required' => false,
            ])
            ->add('city', TextType::class, [
                'required' => false,
            ])
            ->add('illegiblePlate', CheckboxType::class, [
                'required' => false,
            ])
            ->add('licensePlate', TextType::class, [
                'required' => false,
            ])
            ->add('enabled', CheckboxType::class, [
                'required' => false,
            ])
            ->add('make', EntityType::class, [
                'class' => 'AppBundle\Entity\Make',
                'choice_label' => 'name',
            ])
            ->add('model', EntityType::class, [
                'class' => 'AppBundle\Entity\Model',
                'choice_label' => 'name',
            ])
            ->add('spotter', EntityType::class, [
                'class' => 'AppBundle\Entity\Spotter',
                'choice_label' => 'username',
            ])
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'app_spot';
    }
}
