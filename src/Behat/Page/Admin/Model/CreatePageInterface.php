<?php

namespace Behat\Page\Admin\Model;

use Behat\Page\Admin\Crud\CreatePageInterface as BaseCreatePageInterface;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
interface CreatePageInterface extends BaseCreatePageInterface
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
