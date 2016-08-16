<?php

namespace spec\AppBundle\Form\Type;

use AppBundle\Form\Type\MakeType;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormTypeInterface;

/**
 * @mixin MakeType
 *
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
final class MakeTypeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('Make', []);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Form\Type\MakeType');
    }

    function it_is_a_form_type()
    {
        $this->shouldImplement(FormTypeInterface::class);
    }

    function it_is_a_resource_type()
    {
        $this->shouldImplement(AbstractResourceType::class);
    }

    function it_builds_form_with_proper_fields(FormBuilderInterface $builder)
    {
        $builder
            ->add('name', TextType::class, Argument::any())
            ->shouldBeCalled()
            ->willReturn($builder)
        ;

        $builder
            ->add('file', FileType::class, Argument::any())
            ->shouldBeCalled()
            ->willReturn($builder)
        ;

        $this->buildForm($builder, []);
    }

    function it_has_valid_name()
    {
        $this->getName()->shouldReturn('app_make');
    }
}
