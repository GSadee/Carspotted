<?php

namespace Behat\Page\Admin\Make;

use Behat\Mink\Exception\ElementNotFoundException;
use Behat\Page\Admin\Crud\CreatePage as BaseCreatePage;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class CreatePage extends BaseCreatePage implements CreatePageInterface
{
    /**
     * {@inheritdoc}
     */
    public function specifyName($name)
    {
        $this->getDocument()->fillField('Name', $name);
    }

    /**
     * {@inheritdoc}
     */
    public function attachLogo($path)
    {
        $filesPath = $this->getParameter('files_path');
        $this->getDocument()->attachFileToField('Logo', $filesPath.'logos/'.$path);
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
            'name' => '#app_make_name',
        ]);
    }
}
