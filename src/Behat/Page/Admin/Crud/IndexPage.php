<?php

namespace Behat\Page\Admin\Crud;

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
     * @var string
     */
    private $resourceName;

    /**
     * @param Session $session
     * @param array $parameters
     * @param RouterInterface $router
     * @param TableAccessorInterface $tableAccessor
     * @param string $resourceName
     */
    public function __construct(
        Session $session,
        array $parameters,
        RouterInterface $router,
        TableAccessorInterface $tableAccessor,
        $resourceName
    ) {
        parent::__construct($session, $parameters, $router);

        $this->tableAccessor = $tableAccessor;
        $this->resourceName = strtolower($resourceName);
    }

    /**
     * {@inheritdoc}
     */
    public function getRouteName()
    {
        return sprintf('app_admin_%s_index', $this->getResourceName());
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
    public function deleteResourceOnPage(array $parameters)
    {
        $tableAccessor = $this->getTableAccessor();
        $table = $this->getElement('table');

        $deletedRow = $tableAccessor->getRowWithFields($table, $parameters);
        $actionButtons = $tableAccessor->getFieldFromRow($table, $deletedRow, 'Actions');

        $actionButtons->pressButton('Delete');
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefinedElements()
    {
        return array_merge(parent::getDefinedElements(), [
            'table' => '.table',
        ]);
    }

    /**
     * @return string
     */
    protected function getResourceName()
    {
        return $this->resourceName;
    }

    /**
     * @return TableAccessorInterface
     */
    protected function getTableAccessor()
    {
        return $this->tableAccessor;
    }
}
