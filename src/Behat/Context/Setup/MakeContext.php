<?php

namespace Behat\Context\Setup;

use AppBundle\Entity\MakeInterface;
use Behat\Behat\Context\Context;
use Behat\Service\SharedStorageInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
final class MakeContext implements Context
{
    /**
     * @var SharedStorageInterface
     */
    private $sharedStorage;

    /**
     * @var RepositoryInterface
     */
    private $makeRepository;

    /**
     * @var FactoryInterface
     */
    private $makeFactory;

    /**
     * @var ObjectManager
     */
    private $makeManager;

    /**
     * @param SharedStorageInterface $sharedStorage
     * @param RepositoryInterface $makeRepository
     * @param FactoryInterface $makeFactory
     * @param ObjectManager $makeManager
     */
    public function __construct(
        SharedStorageInterface $sharedStorage,
        RepositoryInterface $makeRepository,
        FactoryInterface $makeFactory,
        ObjectManager $makeManager
    ) {
        $this->sharedStorage = $sharedStorage;
        $this->makeRepository = $makeRepository;
        $this->makeFactory = $makeFactory;
        $this->makeManager = $makeManager;
    }

    /**
     * @Given there is a make :name
     * @Given there is also a make :name
     */
    public function thereIsAMake($name)
    {
        $this->createMake($name);
    }

    /**
     * @param string $name
     */
    private function createMake($name)
    {
        $make = $this->makeFactory->createNew();
        $make->setName($name);

        $this->sharedStorage->set('make', $make);

        $this->makeRepository->add($make);
        $this->makeManager->flush();
    }
}
