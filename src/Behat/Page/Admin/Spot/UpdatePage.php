<?php

namespace Behat\Page\Admin\Spot;

use Behat\Mink\Exception\ElementNotFoundException;
use Behat\Page\Admin\Crud\UpdatePage as BaseUpdatePage;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class UpdatePage extends BaseUpdatePage implements UpdatePageInterface
{
    /**
     * {@inheritdoc}
     */
    public function checkValidationMessageFor($element, $message)
    {
        $errorLabel = $this->getElement($element)->getParent()->getParent()->find('css', '.alert');

        if (null === $errorLabel) {
            throw new ElementNotFoundException($this->getSession(), 'Validation message', 'css', '.alert');
        }

        return $message === $errorLabel->getText();
    }

    /**
     * {@inheritdoc}
     */
    public function chooseMake($makeName)
    {
        if (null !== $makeName) {
            $this->getDocument()->selectFieldOption('Make', $makeName);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function chooseModel($modelName)
    {
        if (null !== $modelName) {
            $this->getDocument()->selectFieldOption('Model', $modelName);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function chooseSpotter($spotterName)
    {
        if (null !== $spotterName) {
            $this->getDocument()->selectFieldOption('Spotter', $spotterName);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function enable()
    {
        $this->getDocument()->checkField('Enabled');
    }

    /**
     * {@inheritdoc}
     */
    public function disable()
    {
        $this->getDocument()->uncheckField('Enabled');
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefinedElements()
    {
        return array_merge(parent::getDefinedElements(), [
        ]);
    }
}
