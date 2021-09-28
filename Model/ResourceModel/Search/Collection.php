<?php

namespace CodeCustom\NovaPoshta\Model\ResourceModel\Search;

use CodeCustom\NovaPoshta\Model\Search;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use CodeCustom\NovaPoshta\Model\ResourceModel\Search as SearchResource;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(Search::class, SearchResource::class);
    }
}
