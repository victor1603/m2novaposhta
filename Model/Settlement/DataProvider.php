<?php

namespace CodeCustom\NovaPoshta\Model\Settlement;

use Magento\Ui\DataProvider\AbstractDataProvider;
use CodeCustom\NovaPoshta\Model\ResourceModel\Settlement\Collection;

class DataProvider extends AbstractDataProvider
{

    /**
     * @var Collection
     */
    protected $collection;

    /*
     * Load data from colection
     */
    protected $_loadedData;

    public function __construct(
        $name, $primaryFieldName,
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
        if(isset($this->_loadedData)) {
            return $this->_loadedData;
        }

        $items = $this->collection->getItems();

        foreach($items as $contact)
        {
            $this->_loadedData[$contact->getId()] = $contact->getData();
        }

        if (!$this->_loadedData) {
            $this->_loadedData[1]['ref'] = 'efoejfiefuehfeufheufe';
        }

        return $this->_loadedData;
    }

    /**
     * Code for Add "Use Default Value" Checkbox in UI Form
     */
    public function getMeta()
    {
        $meta = parent::getMeta();
        //$meta['settlement_fieldset']['children']['ref']['arguments']['data']['config']['default'] = $this->getRef();
        return $meta;
    }

    public function getRef()
    {
        return 'felkgeugege';
    }

}
