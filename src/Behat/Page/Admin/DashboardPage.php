<?php

namespace Behat\Page\Admin;

use Behat\Mink\Session;
use Behat\Page\SymfonyPage;
use Behat\Service\Accessor\TableAccessorInterface;
use Symfony\Component\Routing\RouterInterface;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class DashboardPage extends SymfonyPage implements DashboardPageInterface
{
    /**
     * @var TableAccessorInterface
     */
    private $tableAccessor;

    /**
     * @param Session $session
     * @param array $parameters
     * @param RouterInterface $router
     * @param TableAccessorInterface $tableAccessor
     */
    public function __construct(
        Session $session,
        array $parameters,
        RouterInterface $router,
        TableAccessorInterface $tableAccessor
    ) {
        parent::__construct($session, $parameters, $router);

        $this->tableAccessor = $tableAccessor;
    }

    /**
     * {@inheritdoc}
     */
    public function getRouteName()
    {
        return 'app_admin_dashboard';
    }

    /**
     * {@inheritdoc}
     */
    public function getHeader()
    {
        return $this->getElement('header')->getHtml();
    }

    /**
     * {@inheritdoc}
     */
    public function countSpots()
    {
        return $this->tableAccessor->countTableBodyRows($this->getElement('recent_spots'));
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefinedElements()
    {
        return array_merge(parent::getDefinedElements(), [
            'header' => 'h1.page-header',
            'recent_spots' => 'table#recent-spots',
        ]);
    }
}
