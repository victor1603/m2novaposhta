<?php

namespace CodeCustom\NovaPoshta\Model\ResourceModel\City;

use CodeCustom\NovaPoshta\Model\City;
use CodeCustom\NovaPoshta\Model\ResourceModel\City as CityResource;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(City::class, CityResource::class);
    }

}
