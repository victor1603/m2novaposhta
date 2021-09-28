<?php

namespace CodeCustom\NovaPoshta\Model\Settlement;

use Magento\Ui\DataProvider\AbstractDataProvider;
use CodeCustom\NovaPoshta\Model\ResourceModel\Settlement\Collection;

class SearchResult extends AbstractDataProvider
{

    protected $collection;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        Collection $collection,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $collection;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        return parent::getData();
    }
}
