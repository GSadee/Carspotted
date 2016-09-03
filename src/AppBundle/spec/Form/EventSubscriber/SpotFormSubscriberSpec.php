<?php

namespace spec\AppBundle\Form\EventSubscriber;

use AppBundle\Entity\SpotInterface;
use AppBundle\Entity\SpotterInterface;
use AppBundle\Form\EventSubscriber\SpotFormSubscriber;
use PhpSpec\ObjectBehavior;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * @mixin SpotFormSubscriber
 *
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class SpotFormSubscriberSpec extends ObjectBehavior
{
    function let(SecurityContextInterface $securityContext)
    {
        $this->beConstructedWith($securityContext);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Form\EventSubscriber\SpotFormSubscriber');
    }

    function it_is_event_subscriber_instance()
    {
        $this->shouldImplement(EventSubscriberInterface::class);
    }

    function it_listens_on_submit_data_event()
    {
        $this->getSubscribedEvents()->shouldReturn([FormEvents::SUBMIT => 'submit',]);
    }

    function it_sets_spotter(
        FormEvent $event,
        SecurityContextInterface $securityContext,
        SpotInterface $spot,
        TokenInterface $token,
        SpotterInterface $spotter
    ) {
        $event->getData()->willReturn($spot);

        $securityContext->getToken()->willReturn($token);
        $token->getUser()->willReturn($spotter);

        $spot->setSpotter($spotter)->shouldBeCalled();

        $this->submit($event);
    }

    function it_throws_unexpected_type_exception_if_data_is_not_spot_type(
        FormEvent $event,
        SpotterInterface $spotter
    ) {
        $event->getData()->willReturn($spotter);

        $this->shouldThrow(UnexpectedTypeException::class)->during('submit', [$event]);
    }
}
