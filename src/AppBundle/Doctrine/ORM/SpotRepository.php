<?php

namespace AppBundle\Doctrine\ORM;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class SpotRepository extends EntityRepository implements SpotRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findByCreatedAt($limit = 10)
    {
        $queryBuilder = $this->createQueryBuilder('o');

        $queryBuilder
            ->addOrderBy('o.createdAt', 'DESC')
            ->setMaxResults($limit)
        ;

        return $queryBuilder->getQuery()->getResult();
    }

    /**
     * {@inheritdoc}
     */
    public function createEnabledPaginator()
    {
        $queryBuilder = $this->createQueryBuilder('o');

        $queryBuilder
            ->where('o.enabled = true')
            ->addOrderBy('o.createdAt', 'DESC')
        ;

        return $this->getPaginator($queryBuilder);
    }
}
