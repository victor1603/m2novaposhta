<?php

namespace CodeCustom\NovaPoshta\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Search extends AbstractDb
{
    protected function _construct()
    {
        $this->_init(
            'code_custom_novaposhta_search_temp',
            'entity_id'
        );
    }
}
