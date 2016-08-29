<?php

namespace Behat\Page\Spot;

use Behat\Mink\Exception\ElementNotFoundException;
use Behat\Mink\Session;
use Behat\Page\SymfonyPage;
use Behat\Service\Accessor\TableAccessorInterface;
use Symfony\Component\Routing\RouterInterface;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class IndexPage extends SymfonyPage implements IndexPageInterface
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
        return 'app_spot_index';
    }

    /**
     * {@inheritdoc}
     */
    public function isSingleResourceOnPage(array $parameters)
    {
        try {
            $rows = $this->tableAccessor->getRowsWithFields($this->getElement('table'), $parameters);

            return 1 === count($rows);
        } catch (\InvalidArgumentException $exception) {
            return false;
        } catch (ElementNotFoundException $exception) {
            return false;
        }
    }

    /**
     * @return int
     */
    public function countItems()
    {
        try {
            return $this->getTableAccessor()->countTableBodyRows($this->getElement('table'));
        } catch (ElementNotFoundException $exception) {
            return 0;
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefinedElements()
    {
        return array_merge(parent::getDefinedElements(), [
            'table' => 'table',
        ]);
    }

    /**
     * @return TableAccessorInterface
     */
    protected function getTableAccessor()
    {
        return $this->tableAccessor;
    }
}
