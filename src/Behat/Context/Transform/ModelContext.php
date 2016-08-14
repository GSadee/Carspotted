<?php

namespace Behat\Context\Transform;

use Behat\Behat\Context\Context;
use Sylius\Component\Resource\Repository\RepositoryInterface;
use Webmozart\Assert\Assert;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
final class ModelContext implements Context
{
    /**
     * @var RepositoryInterface
     */
    private $modelRepository;

    /**
     * @param RepositoryInterface $modelRepository
     */
    public function __construct(RepositoryInterface $modelRepository)
    {
        $this->modelRepository = $modelRepository;
    }

    /**
     * @Transform :model
     * @Transform /^model "([^"]*)"$/
     */
    public function getModelByName($modelName)
    {
        $model = $this->modelRepository->findOneByName($modelName);

        Assert::notNull(
            $model,
            sprintf('Model with name "%s" does not exist', $modelName)
        );

        return $model;
    }
}
