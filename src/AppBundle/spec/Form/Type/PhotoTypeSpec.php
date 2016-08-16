<?php

namespace spec\AppBundle\Form\Type;

use AppBundle\Form\Type\PhotoType;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\Form\FormTypeInterface;

/**
 * @mixin PhotoType
 *
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
final class PhotoTypeSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('Photo', []);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Form\Type\PhotoType');
    }

    function it_is_a_form_type()
    {
        $this->shouldImplement(FormTypeInterface::class);
    }

    function it_is_a_resource_type()
    {
        $this->shouldImplement(AbstractResourceType::class);
    }

    function it_should_build_form_with_proper_fields(FormBuilder $builder)
    {
        $builder
            ->add('file', FileType::class, Argument::any())
            ->shouldBeCalled()
            ->willReturn($builder)
        ;

        $this->buildForm($builder, []);
    }

    function it_has_valid_name()
    {
        $this->getName()->shouldReturn('app_photo');
    }
}
