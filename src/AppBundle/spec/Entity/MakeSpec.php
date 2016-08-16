<?php

namespace spec\AppBundle\Entity;

use AppBundle\Entity\Make;
use AppBundle\Entity\MakeInterface;
use AppBundle\Entity\ModelInterface;
use Doctrine\Common\Collections\Collection;
use PhpSpec\ObjectBehavior;

/**
 * @mixin Make
 *
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

    function it_has_no_file_by_default()
    {
        $this->hasFile()->shouldReturn(false);
        $this->getFile()->shouldReturn(null);
    }

    function its_file_is_mutable()
    {
        $file = new \SplFileInfo(__FILE__);
        $this->setFile($file);
        $this->getFile()->shouldReturn($file);
    }

    function it_has_no_path_by_default()
    {
        $this->hasPath()->shouldReturn(false);
        $this->getPath()->shouldReturn(null);
    }

    function its_path_is_mutable()
    {
        $path = __FILE__;
        $this->setPath($path);
        $this->getPath()->shouldReturn($path);
    }
}
