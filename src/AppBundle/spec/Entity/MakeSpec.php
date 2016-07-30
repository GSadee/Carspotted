<?php

namespace spec\AppBundle\Entity;

use AppBundle\Entity\MakeInterface;
use AppBundle\Entity\ModelInterface;
use Doctrine\Common\Collections\Collection;
use PhpSpec\ObjectBehavior;

/**
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class MakeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Entity\Make');
    }

    function it_implements_make_interface()
    {
        $this->shouldImplement(MakeInterface::class);
    }

    function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    function it_has_no_name_by_default()
    {
        $this->getName()->shouldReturn(null);
    }

    function its_name_is_mutable()
    {
        $this->setName('Opel');
        $this->getName()->shouldReturn('Opel');
    }

    function it_initializes_model_collection_by_default()
    {
        $this->getModels()->shouldHaveType(Collection::class);
    }

    function its_models_are_mutable(Collection $models)
    {
        $this->setModels($models);
        $this->getModels()->shouldReturn($models);
    }

    function it_adds_model(ModelInterface $model)
    {
        $this->addModel($model);

        $this->hasModel($model)->shouldReturn(true);
    }

    function it_removes_model(ModelInterface $model)
    {
        $this->addModel($model);
        $this->removeModel($model);

        $this->hasModel($model)->shouldReturn(false);
    }
}
