<?php

namespace Behat\Page\Admin\Spot;

use Behat\Page\Admin\Crud\UpdatePageInterface as BaseUpdatePageInterface;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
interface UpdatePageInterface extends BaseUpdatePageInterface
{
    /**
     * @param string $makeName
     */
    public function chooseMake($makeName);

    /**
     * @param string $modelName
     */
    public function chooseModel($modelName);

    /**
     * @param string $spotterName
     */
    public function chooseSpotter($spotterName);

    public function enable();

    public function disable();
}
