<?php


namespace CodeCustom\NovaPoshta\Model\ResourceModel\Area;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init(CodeCustom\NovaPoshta\Model\Area::class,
            \CodeCustom\NovaPoshta\Model\ResourceModel\Area::class);
    }

}
