<?php

namespace AppBundle\Form\Type;

use AppBundle\Form\EventSubscriber\SpotFormSubscriber;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class SpotType extends AbstractResourceType
{
    /**
     * @var SecurityContextInterface
     */
    private $securityContext;

    /**
     * @param string   $dataClass
     * @param string[] $validationGroups
     * @param SecurityContextInterface $securityContext
     */
    public function __construct($dataClass, array $validationGroups = [], SecurityContextInterface $securityContext)
    {
        parent::__construct($dataClass, $validationGroups);

        $this->securityContext = $securityContext;
    }

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
            ->add('photos', CollectionType::class, [
                'type' => 'app_photo',
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
            ->addEventSubscriber(new SpotFormSubscriber($this->securityContext))
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
