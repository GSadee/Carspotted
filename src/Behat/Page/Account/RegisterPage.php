<?php

namespace Behat\Page\Account;

use Behat\Mink\Exception\ElementNotFoundException;
use Behat\Page\SymfonyPage;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class RegisterPage extends SymfonyPage implements RegisterPageInterface
{
    /**
     * {@inheritdoc}
     */
    public function getRouteName()
    {
        return 'fos_user_registration_register';
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
    public function confirmPassword($password)
    {
        $this->getDocument()->fillField('Repeat password', $password);
    }

    /**
     * {@inheritdoc}
     */
    public function specifyEmail($email)
    {
        $this->getDocument()->fillField('Email', $email);
    }

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->getDocument()->pressButton('Register');
    }
}
