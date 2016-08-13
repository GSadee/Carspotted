<?php

namespace Behat\Context\Transform;

use Behat\Behat\Context\Context;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Webmozart\Assert\Assert;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
final class MakeContext implements Context
{
    /**
     * @var RepositoryInterface
     */
    private $makeRepository;

    /**
     * @param RepositoryInterface $makeRepository
     */
    public function __construct(RepositoryInterface $makeRepository)
    {
        $this->makeRepository = $makeRepository;
    }

    /**
     * @Transform :make
     */
    public function getMakeByName($makeName)
    {
        $make = $this->makeRepository->findOneByName($makeName);

        Assert::notNull(
            $make,
            sprintf('Make with name "%s" does not exist', $makeName)
        );

        return $make;
    }
}
