<?php

namespace Behat\Page\Admin\Crud;

use Behat\Mink\Exception\ElementNotFoundException;
use Behat\Mink\Session;
use Behat\Page\SymfonyPage;
use Symfony\Component\Routing\RouterInterface;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class CreatePage extends SymfonyPage implements CreatePageInterface
{
    /**
     * @var string
     */
    private $resourceName;

    /**
     * @param Session $session
     * @param array $parameters
     * @param RouterInterface $router
     * @param string $resourceName
     */
    public function __construct(Session $session, array $parameters, RouterInterface $router, $resourceName)
    {
        parent::__construct($session, $parameters, $router);

        $this->resourceName = strtolower($resourceName);
    }

    /**
     * {@inheritdoc}
     */
    public function getRouteName()
    {
        return sprintf('app_admin_%s_create', $this->getResourceName());
    }

    /**
     * {@inheritdoc}
     */
    public function create()
    {
        $this->getDocument()->pressButton('Create');
    }

    /**
     * {@inheritdoc}
     */
    public function getValidationMessage($element)
    {
        $foundElement = $this->getFieldElement($element);
        if (null === $foundElement) {
            throw new ElementNotFoundException($this->getSession(), 'Field element');
        }

        $validationMessage = $foundElement->find('css', '.alert.alert-danger');
        if (null === $validationMessage) {
            throw new ElementNotFoundException($this->getSession(), 'Validation message', 'css', '.alert.alert-danger');
        }

        return $validationMessage->getText();
    }

    /**
     * @return string
     */
    protected function getResourceName()
    {
        return $this->resourceName;
    }

    /**
     * @param string $element
     *
     * @return \Behat\Mink\Element\NodeElement|null
     *
     * @throws ElementNotFoundException
     */
    private function getFieldElement($element)
    {
        $element = $this->getElement($element);
        while (null !== $element && !($element->hasClass('field'))) {
            $element = $element->getParent();
        }

        return $element;
    }
}