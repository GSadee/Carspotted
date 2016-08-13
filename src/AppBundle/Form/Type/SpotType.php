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
            ->add('description', TextareaType::class)
            ->add('lat', NumberType::class)
            ->add('lng', NumberType::class)
            ->add('country', TextType::class)
            ->add('city', TextType::class)
            ->add('illegiblePlate', CheckboxType::class)
            ->add('licensePlate', TextType::class)
            ->add('enabled', CheckboxType::class)
            ->add('make', EntityType::class, array(
                'class' => 'AppBundle\Entity\Make',
                'choice_label' => 'name',
            ))
            ->add('model', EntityType::class, array(
                'class' => 'AppBundle\Entity\Model',
                'choice_label' => 'name',
            ))
            ->add('spotter', EntityType::class, array(
                'class' => 'AppBundle\Entity\Spotter',
                'choice_label' => 'username',
            ))
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
