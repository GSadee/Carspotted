<?php

namespace spec\AppBundle\Entity;

use AppBundle\Entity\MakeInterface;
use AppBundle\Entity\ModelInterface;
use AppBundle\Entity\PhotoInterface;
use AppBundle\Entity\Spot;
use AppBundle\Entity\SpotInterface;
use AppBundle\Entity\SpotterInterface;
use Doctrine\Common\Collections\Collection;
use PhpSpec\ObjectBehavior;

/**
 * @mixin Spot
 *
 * @author Grzegorz Sadowski <sadowskigp@gmail.com>
 */
class SpotSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('AppBundle\Entity\Spot');
    }

    function it_implements_spot_interface()
    {
        $this->shouldImplement(SpotInterface::class);
    }

    function it_has_no_id_by_default()
    {
        $this->getId()->shouldReturn(null);
    }

    function it_has_no_description_by_default()
    {
        $this->getDescription()->shouldReturn(null);
    }

    function its_description_is_mutable()
    {
        $this->setDescription('First spot description');
        $this->getDescription()->shouldReturn('First spot description');
    }

    function it_has_no_make_by_default()
    {
        $this->getMake()->shouldReturn(null);
    }

    function its_make_is_mutable(MakeInterface $make)
    {
        $this->setMake($make);
        $this->getMake()->shouldReturn($make);
    }

    function it_has_no_model_by_default()
    {
        $this->getModel()->shouldReturn(null);
    }

    function its_model_is_mutable(ModelInterface $model)
    {
        $this->setModel($model);
        $this->getModel()->shouldReturn($model);
    }

    function it_has_no_spotter_by_default()
    {
        $this->getSpotter()->shouldReturn(null);
    }

    function its_spotter_is_mutable(SpotterInterface $spotter)
    {
        $this->setSpotter($spotter);
        $this->getSpotter()->shouldReturn($spotter);
    }

    function it_initializes_photo_collection_by_default()
    {
        $this->getPhotos()->shouldHaveType(Collection::class);
    }

    function its_photos_are_mutable(Collection $photos)
    {
        $this->setPhotos($photos);
        $this->getPhotos()->shouldReturn($photos);
    }

    function it_adds_photo(PhotoInterface $photo)
    {
        $this->addPhoto($photo);

        $this->hasPhoto($photo)->shouldReturn(true);
    }

    function it_removes_photo(PhotoInterface $photo)
    {
        $this->addPhoto($photo);
        $this->removePhoto($photo);

        $this->hasPhoto($photo)->shouldReturn(false);
    }

    function it_initializes_creation_date_by_default()
    {
        $this->getCreatedAt()->shouldHaveType('\DateTime');
    }

    function it_has_no_lat_by_default()
    {
        $this->getLat()->shouldReturn(null);
    }

    function its_lat_is_mutable($lat)
    {
        $this->setLat($lat);
        $this->getLat()->shouldReturn($lat);
    }

    function it_has_no_lng_by_default()
    {
        $this->getLng()->shouldReturn(null);
    }

    function its_lng_is_mutable($lng)
    {
        $this->setLng($lng);
        $this->getLng()->shouldReturn($lng);
    }

    function it_has_no_country_by_default()
    {
        $this->getCountry()->shouldReturn(null);
    }

    function its_country_is_mutable($country)
    {
        $this->setCountry($country);
        $this->getCountry()->shouldReturn($country);
    }

    function it_has_no_city_by_default()
    {
        $this->getCity()->shouldReturn(null);
    }

    function its_city_is_mutable($city)
    {
        $this->setCity($city);
        $this->getCity()->shouldReturn($city);
    }

    function it_has_illegible_plate_as_false_by_default()
    {
        $this->isIllegiblePlate()->shouldReturn(false);
    }

    function its_illegible_plate_is_mutable($illegiblePlate)
    {
        $this->setIllegiblePlate($illegiblePlate);
        $this->isIllegiblePlate()->shouldReturn($illegiblePlate);
    }

    function it_has_no_license_plate_by_default()
    {
        $this->getLicensePlate()->shouldReturn(null);
    }

    function its_license_plate_is_mutable($licensePlate)
    {
        $this->setLicensePlate($licensePlate);
        $this->getLicensePlate()->shouldReturn($licensePlate);
    }

    function it_disabled_by_default()
    {
        $this->isEnabled()->shouldReturn(false);
    }

    function it_can_be_enabled($enabled)
    {
        $this->setEnabled($enabled);
        $this->isEnabled()->shouldReturn($enabled);
    }
}
