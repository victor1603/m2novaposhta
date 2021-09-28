<?php

namespace CodeCustom\NovaPoshta\Model;

use CodeCustom\NovaPoshta\Api\Data\SearchInterface;
use Magento\Framework\Model\AbstractModel;

class Search extends AbstractModel implements SearchInterface
{

    const SETTLEMENT_SEARCH_KEY = 'settlement_search';

    public function _construct()
    {
        $this->_init(\CodeCustom\NovaPoshta\Model\ResourceModel\Search::class);
    }

    /**
     * @param $search_key
     * @return mixed|void
     */
    public function setSearchKey($search_key)
    {
        $this->setData('search_key', $search_key);
    }

    /**
     * @return array|mixed|null
     */
    public function getSearchKey()
    {
        return $this->getData('search_key');
    }

    /**
     * @param $search_value
     * @return mixed|void
     */
    public function setSearchValue($search_value)
    {
        $this->setData('search_value', $search_value);
    }

    /**
     * @return array|mixed|null
     */
    public function getSearchValue()
    {
        return $this->getData('search_value');
    }
}
