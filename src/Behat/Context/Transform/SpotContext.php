<?php

namespace Behat\Context\Transform;

use AppBundle\Doctrine\ORM\SpotRepositoryInterface;
use Behat\Behat\Context\Context;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Webmozart\Assert\Assert;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
final class SpotContext implements Context
{
    /**
     * @var RepositoryInterface
     */
    private $makeRepository;

    /**
     * @var RepositoryInterface
     */
    private $modelRepository;

    /**
     * @var SpotRepositoryInterface
     */
    private $spotRepository;

    /**
     * @param RepositoryInterface $makeRepository
     * @param RepositoryInterface $modelRepository
     * @param SpotRepositoryInterface $spotRepository
     */
    public function __construct(
        RepositoryInterface $makeRepository,
        RepositoryInterface $modelRepository,
        SpotRepositoryInterface $spotRepository
    ) {
        $this->makeRepository = $makeRepository;
        $this->modelRepository = $modelRepository;
        $this->spotRepository = $spotRepository;
    }

    /**
     * @Transform /^the spot "([^"]+)" "([^"]+)"$/
     */
    public function getLastSpotByMakeAndModel($makeName, $modelName)
    {
        $make = $this->makeRepository->findOneByName($makeName);
        $model = $this->modelRepository->findOneByName($modelName);
        $spot = $this->spotRepository->findOneByMakeAndModel($make, $model);

        Assert::notNull(
            $spot,
            sprintf('Spot "%s %s" does not exist', $makeName, $modelName)
        );

        return $spot;
    }
}
