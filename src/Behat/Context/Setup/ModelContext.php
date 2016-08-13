<?php

namespace Behat\Context\Setup;

use AppBundle\Entity\Make;
use AppBundle\Entity\MakeInterface;
use Behat\Behat\Context\Context;
use Behat\Service\SharedStorageInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
final class ModelContext implements Context
{
    /**
     * @var SharedStorageInterface
     */
    private $sharedStorage;

    /**
     * @var RepositoryInterface
     */
    private $modelRepository;

    /**
     * @var FactoryInterface
     */
    private $modelFactory;

    /**
     * @var ObjectManager
     */
    private $modelManager;

    /**
     * @var RepositoryInterface
     */
    private $makeRepository;

    /**
     * @var FactoryInterface
     */
    private $makeFactory;

    /**
     * @param SharedStorageInterface $sharedStorage
     * @param RepositoryInterface $modelRepository
     * @param FactoryInterface $modelFactory
     * @param ObjectManager $modelManager
     * @param RepositoryInterface $makeRepository
     * @param FactoryInterface $makeFactory
     */
    public function __construct(
        SharedStorageInterface $sharedStorage,
        RepositoryInterface $modelRepository,
        FactoryInterface $modelFactory,
        ObjectManager $modelManager,
        RepositoryInterface $makeRepository,
        FactoryInterface $makeFactory
    ) {
        $this->sharedStorage = $sharedStorage;
        $this->modelRepository = $modelRepository;
        $this->modelFactory = $modelFactory;
        $this->modelManager = $modelManager;
        $this->makeRepository = $makeRepository;
        $this->makeFactory = $makeFactory;
    }

    /**
     * @Given there is a model :name made by :makeName
     * @Given there is also a model :name made by :makeName
     */
    public function thereIsAModelMadeByMake($name, $makeName)
    {
        $make = $this->getOrCreateMake($makeName);
        $this->createModel($name, $make);
    }

    /**
     * @param string $name
     *
     * @return MakeInterface
     */
    private function getOrCreateMake($name)
    {
        $make = $this->makeRepository->findOneBy(['name' => $name]);
        if (null !== $make) {
            return $make;
        }

        $make = $this->makeFactory->createNew();
        $make->setName($name);

        $this->sharedStorage->set('make', $make);

        $this->makeRepository->add($make);

        return $make;
    }

    /**
     * @param string $name
     */
    private function createModel($name, MakeInterface $make)
    {
        $model = $this->modelFactory->createNew();
        $model->setName($name);
        $model->setMake($make);

        $this->sharedStorage->set('model', $model);

        $this->modelRepository->add($model);
        $this->modelManager->flush();
    }
}
