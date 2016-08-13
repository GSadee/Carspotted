<?php

namespace Behat\Page\Admin\Make;

use Behat\Page\Admin\Crud\CreatePage as BaseCreatePage;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class CreatePage extends BaseCreatePage implements CreatePageInterface
{
    /**
     * @param string $name
     */
    public function specifyName($name)
    {
        $this->getDocument()->fillField('Name', $name);
    }
}
