<?php

namespace Behat\Context\Transform;

use Behat\Behat\Context\Context;
use Behat\Service\SharedStorageInterface;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
final class SharedStorageContext implements Context
{
    /**
     * @var SharedStorageInterface
     */
    private $sharedStorage;

    /**
     * @param SharedStorageInterface $sharedStorage
     */
    public function __construct(SharedStorageInterface $sharedStorage)
    {
        $this->sharedStorage = $sharedStorage;
    }

    /**
     * @Transform /^(?:this|that|the) ([^"]+)$/
     */
    public function getResource($resource)
    {
        return $this->sharedStorage->get(str_replace(' ', '_', $resource));
    }
}
