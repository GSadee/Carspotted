<?php

namespace Behat\Page\Admin\Model;

use Behat\Page\Admin\Crud\UpdatePageInterface as BaseUpdatePageInterface;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
interface UpdatePageInterface extends BaseUpdatePageInterface
{
    /**
     * @param string $name
     */
    public function specifyName($name);

    /**
     * @param string $makeName
     */
    public function chooseMake($makeName);
}
