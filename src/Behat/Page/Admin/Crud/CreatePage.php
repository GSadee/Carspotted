<?php

namespace Behat\Page\Admin\Crud;

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
     * @return string
     */
    protected function getResourceName()
    {
        return $this->resourceName;
    }
}
