<?php

namespace CodeCustom\NovaPoshta\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Area extends AbstractDb
{

    public function _construct()
    {
        $this->_init('code_custom_novaposhta_areas', 'enity_id');
    }
}
