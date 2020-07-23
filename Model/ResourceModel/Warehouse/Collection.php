<?php

namespace CodeCustom\NovaPoshta\Model\ResourceModel\Warehouse;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use CodeCustom\NovaPoshta\Model\Warehouse as WarehouseModel;
use CodeCustom\NovaPoshta\Model\ResourceModel\Warehouse as WarehouseResource;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(WarehouseModel::class, WarehouseResource::class);
    }

}
