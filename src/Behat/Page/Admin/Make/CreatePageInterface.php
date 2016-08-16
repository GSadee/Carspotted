<?php

namespace Behat\Page\Admin\Make;

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
     * @param string $path
     */
    public function attachLogo($path);
}
