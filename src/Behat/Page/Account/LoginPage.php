<?php

namespace Behat\Page\Account;

use Behat\Page\SymfonyPage;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class LoginPage extends SymfonyPage implements LoginPageInterface
{
    /**
     * {@inheritdoc}
     */
    public function getRouteName()
    {
        return 'fos_user_security_login';
    }

    /**
     * {@inheritdoc}
     */
    public function specifyUsername($username)
    {
        $this->getDocument()->fillField('Username', $username);
    }

    /**
     * {@inheritdoc}
     */
    public function specifyPassword($password)
    {
        $this->getDocument()->fillField('Password', $password);
    }

    /**
     * {@inheritdoc}
     */
    public function signIn()
    {
        $this->getDocument()->pressButton('Sign in');
    }
    /**
     * {@inheritdoc}
     */
    public function hasValidationErrorWith($message)
    {
        return $this->getElement('validation_error')->getText() === $message;
    }

    /**
     * {@inheritdoc}
     */
    protected function getDefinedElements()
    {
        return array_merge(parent::getDefinedElements(), [
            'validation_error' => '.alert.alert-danger',
        ]);
    }
}
