<?php

namespace CodeCustom\NovaPoshta\Model\ResourceModel\Settlement;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use CodeCustom\NovaPoshta\Model\Settlement as SettlementModel;
use CodeCustom\NovaPoshta\Model\ResourceModel\Settlement as SettlementResource;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(SettlementModel::class, SettlementResource::class);
    }
}
