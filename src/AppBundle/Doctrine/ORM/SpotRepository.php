<?php

namespace AppBundle\Doctrine\ORM;
use AppBundle\Entity\MakeInterface;
use AppBundle\Entity\ModelInterface;
use AppBundle\Entity\SpotterInterface;
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
        return $this->createQueryBuilder('o')
            ->addOrderBy('o.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
        ;
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

    /**
     * {@inheritdoc}
     */
    public function createEnabledBySpotterPaginator(SpotterInterface $spotter)
    {
        $queryBuilder = $this->createQueryBuilder('o');

        $queryBuilder
            ->where('o.spotter = :spotter')
            ->addOrderBy('o.createdAt', 'DESC')
            ->setParameter('spotter', $spotter)
        ;

        return $this->getPaginator($queryBuilder);
    }

    /**
     * {@inheritdoc}
     */
    public function findLatest($limit = 4)
    {
        return $this->createQueryBuilder('o')
            ->where('o.enabled = true')
            ->addOrderBy('o.createdAt', 'DESC')
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function findOneByMakeAndModel(MakeInterface $make, ModelInterface $model)
    {
        return $this->createQueryBuilder('o')
            ->where('o.make = :make')
            ->andWhere('o.model = :model')
            ->addOrderBy('o.createdAt', 'DESC')
            ->setParameter('make', $make)
            ->setParameter('model', $model)
            ->getQuery()
            ->getSingleResult()
        ;
    }
}
