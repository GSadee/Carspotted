<?php

namespace Behat\Page\Admin\Make;

use Behat\Page\Admin\Crud\UpdatePage as BaseUpdatePage;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class UpdatePage extends BaseUpdatePage implements UpdatePageInterface
{
    /**
     * @param string $name
     */
    public function specifyName($name)
    {
        $this->getDocument()->fillField('Name', $name);
    }
}
