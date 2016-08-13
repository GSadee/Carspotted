<?php

namespace Behat\Page\Admin\Model;

use Behat\Mink\Exception\ElementNotFoundException;
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
    protected function getDefinedElements()
    {
        return array_merge(parent::getDefinedElements(), [
            'make' => '#app_model_make',
            'name' => '#app_model_name',
        ]);
    }
}
