<?php

namespace Behat\Page\Admin;

use Behat\Page\SymfonyPage;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class DashboardPage extends SymfonyPage implements DashboardPageInterface
{
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
    protected function getDefinedElements()
    {
        return array_merge(parent::getDefinedElements(), [
            'header' => 'h1.page-header',
        ]);
    }
}
