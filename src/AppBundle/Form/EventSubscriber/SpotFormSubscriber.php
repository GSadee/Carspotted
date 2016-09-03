<?php

namespace AppBundle\Form\EventSubscriber;

use AppBundle\Entity\SpotInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Security\Core\SecurityContextInterface;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class SpotFormSubscriber implements EventSubscriberInterface
{
    /**
     * @var SecurityContextInterface
     */
    private $securityContext;

    /**
     * @param SecurityContextInterface $securityContext
     */
    public function __construct(SecurityContextInterface $securityContext)
    {
        $this->securityContext = $securityContext;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            FormEvents::SUBMIT => 'submit',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function submit(FormEvent $event)
    {
        $spot = $event->getData();
        if (!$spot instanceof SpotInterface) {
            throw new UnexpectedTypeException($spot, SpotInterface::class);
        }

        $spotter = $this->securityContext->getToken()->getUser();

        $spot->setSpotter($spotter);
    }
}
