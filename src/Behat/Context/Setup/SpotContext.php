<?php

namespace Behat\Context\Setup;

use AppBundle\Entity\MakeInterface;
use AppBundle\Entity\ModelInterface;
use AppBundle\Entity\SpotInterface;
use AppBundle\Entity\SpotterInterface;
use Behat\Behat\Context\Context;
use Behat\Service\SharedStorageInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sylius\Component\Resource\Factory\FactoryInterface;
use Sylius\Component\Resource\Repository\RepositoryInterface;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
final class SpotContext implements Context
{
    /**
     * @var SharedStorageInterface
     */
    private $sharedStorage;

    /**
     * @var RepositoryInterface
     */
    private $spotRepository;

    /**
     * @var FactoryInterface
     */
    private $spotFactory;

    /**
     * @var ObjectManager
     */
    private $spotManager;

    /**
     * @param SharedStorageInterface $sharedStorage
     * @param RepositoryInterface $spotRepository
     * @param FactoryInterface $spotFactory
     * @param ObjectManager $spotManager
     */
    public function __construct(
        SharedStorageInterface $sharedStorage,
        RepositoryInterface $spotRepository,
        FactoryInterface $spotFactory,
        ObjectManager $spotManager
    ) {
        $this->sharedStorage = $sharedStorage;
        $this->spotRepository = $spotRepository;
        $this->spotFactory = $spotFactory;
        $this->spotManager = $spotManager;
    }

    /**
     * @Given there is a spot :name made by :makeName
     * @Given there is also a spot :name made by :makeName
     */
    public function thereIsAModelMadeByMake($name, $makeName)
    {
        $make = $this->getOrCreateMake($makeName);
        $this->createModel($name, $make);
    }

    /**
     * @Given /^(this spotter) spotted(?:| also) a (model "[^"]*") (made by "[^"]*")$/
     */
    public function thisUserSpottedAModelMadeBy(SpotterInterface $spotter, ModelInterface $model, MakeInterface $make)
    {
        $this->createSpot($make, $model, $spotter);
    }

    /**
     * @Given /^(this spotter) spotted(?:| also) a (model "[^"]*") (made by "[^"]*") which is enabled$/
     */
    public function thisUserSpottedAModelMadeByWhichIsEnabled(SpotterInterface $spotter, ModelInterface $model, MakeInterface $make)
    {
        $this->createSpot($make, $model, $spotter, true);
    }

    /**
     * @param MakeInterface $make
     * @param ModelInterface $model
     * @param SpotterInterface $spotter
     * @param bool $enabled
     */
    private function createSpot(MakeInterface $make, ModelInterface $model, SpotterInterface $spotter, $enabled = false)
    {
        /** @var SpotInterface $spot */
        $spot = $this->spotFactory->createNew();
        $spot->setMake($make);
        $spot->setModel($model);
        $spot->setSpotter($spotter);
        $spot->setEnabled($enabled);

        $this->sharedStorage->set('spot', $spot);

        $this->spotRepository->add($spot);
        $this->spotManager->flush();
    }
}
