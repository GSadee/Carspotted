<?php

namespace Behat\Service;

/**
 * @author Arkadiusz Krakowiak <arkadiusz.krakowiak@lakion.com>
 */
interface SecurityServiceInterface
{
    /**
     * @param string $username
     *
     * @throws \InvalidArgumentException
     */
    public function logIn($username);
    
    public function logOut();
}
