<?php

namespace Behat\Page\Account;

use Behat\Page\SymfonyPage;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class RegisterConfirmationPage extends SymfonyPage implements RegisterConfirmationPageInterface
{
    /**
     * {@inheritdoc}
     */
    public function getRouteName()
    {
        return 'fos_user_registration_confirmed';
    }

    /**
     * @param string $text
     *
     * @return bool
     */
    public function hasText($text)
    {
        $contentText = $this->getElement('content')->getText();

        return stripos($contentText, $text) !== false;
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefinedElements()
    {
        return array_merge(parent::getDefinedElements(), [
            'content' => 'section',
        ]);
    }
}
