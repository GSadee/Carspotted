<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class Spotter extends User implements SpotterInterface
{
    /**
     * @var mixed
     */
    protected $id;

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    public function __construct()
    {
        parent::__construct();

        $this->salt = null;
    }
}
