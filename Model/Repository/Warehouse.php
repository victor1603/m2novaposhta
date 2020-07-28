<?php

namespace CodeCustom\NovaPoshta\Model\Repository;

use CodeCustom\NovaPoshta\Api\Data\WarehouseInterface;
use CodeCustom\NovaPoshta\Api\WarehouseRepositoryInterface;
use CodeCustom\NovaPoshta\Model\ResourceModel\Warehouse as WarehouseResource;
use CodeCustom\NovaPoshta\Model\WarehouseFactory;
use CodeCustom\NovaPoshta\Model\ResourceModel\Warehouse\CollectionFactory as WarehouseCollectionFactory;
use Magento\Framework\App\RequestInterface;

class Warehouse implements WarehouseRepositoryInterface
{
    /**
     * @var WarehouseResource
     */
    protected $warehouseResource;

    /**
     * @var WarehouseFactory
     */
    protected $warehouseFactory;

    protected $warehouseCollectionFactory;

    protected $request;

    public function __construct(
        WarehouseResource $warehouseResource,
        WarehouseFactory $warehouseFactory,
        WarehouseCollectionFactory $warehouseCollectionFactory,
        RequestInterface $request
    )
    {
        $this->warehouseResource = $warehouseResource;
        $this->warehouseFactory = $warehouseFactory;
        $this->warehouseCollectionFactory = $warehouseCollectionFactory;
        $this->request = $request;
    }

    /**
     * @param WarehouseInterface $warehouse
     * @return mixed|void
     */
    public function save(WarehouseInterface $warehouse)
    {
        try {
            $this->warehouseResource->save($warehouse);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__('Could not save Source'), $exception);
        }
    }

    /**
     * @param string $cityRef
     * @return false|mixed|string
     */
    public function getList($cityRef)
    {
        $collection = $this->warehouseCollectionFactory->create();
        $collection->addFieldToFilter(
            ['city_ref'],
            [
                ['eq' => $cityRef],
            ]
        );
        $data[] = ['text' => __('Choose warehouse'), 'id' => 0];

        if ($collection && $collection->getSize()) {
            foreach ($collection->getItems() as $item) {
                $data[] = ['text' => $item->getDescriptionRu(), 'id' => $item->getRef()];
            }
        }

        return json_encode($data);
    }

    /**
     * @param string $cityRef
     * @param string $search
     * @return mixed
     */
    public function getGraphQlList($cityRef = '', $search = '')
    {
        $collection = $this->warehouseCollectionFactory->create();
        $collection->addFieldToFilter(
            ['city_ref'],
            [
                ['eq' => $cityRef],
            ]
        );

        if ($search) {
            $collection->addFieldToFilter(
                ['description_ru'],
                [
                    ['like' => $search . '%'],
                ]
            );
        }

        $data[] = ['name' => __('Choose warehouse'), 'ref' => 0];

        if ($collection && $collection->getSize()) {
            foreach ($collection->getItems() as $item) {
                $data[] = ['name' => $item->getDescriptionRu(), 'ref' => $item->getRef()];
            }
        }

        return $data;
    }

    /**
     * @param array $warehouses
     * @return bool|mixed
     */
    public function syncLoadedWarehouses(array $warehouses = [])
    {
        if (!empty($warehouses)) {
            foreach ($warehouses as $warehouseData) {
                $warehouse = $this->getByField($warehouseData[self::NP_REF], self::NP_ENTITY_FIELD);
                $warehouse->setSiteKey($warehouseData[self::NP_SITE_KEY]);
                $warehouse->setDescription($warehouseData[self::NP_DESCRIPTION]);
                $warehouse->setDescriptionRu($warehouseData[self::NP_DESCRIPTION_RU]);
                $warehouse->setShortAddress($warehouseData[self::NP_SHORT_ADDRESS]);
                $warehouse->setShortAddressRu($warehouseData[self::NP_SHORT_ADDRESS_RU]);
                $warehouse->setPhone($warehouseData[self::NP_PHONE]);
                $warehouse->setTypeOfWarehouse($warehouseData[self::NP_TYPE_OF_WAREHOUSE]);
                $warehouse->setRef($warehouseData[self::NP_REF]);
                $warehouse->setNumber($warehouseData[self::NP_NUMBER]);
                $warehouse->setCityRef($warehouseData[self::NP_CITY_REF]);
                $warehouse->setCityDescription($warehouseData[self::NP_CITY_DESCRIPTION]);
                $warehouse->setCityDescriptionRu($warehouseData[self::NP_CITY_DESCRIPTION_RU]);
                $warehouse->setSettlementRef($warehouseData[self::NP_SETTLEMENT_REF]);
                $warehouse->setSettlementDescription($warehouseData[self::NP_SETTLEMENT_DESCRIPTION]);
                $warehouse->setSettlementAreaDescription($warehouseData[self::NP_SETTLEMENT_AREA_DESCRIPTION]);
                $warehouse->setSettlementRegionsDescription($warehouseData[self::NP_SETTLEMENT_REGIONS_DESCRIPTION]);
                $warehouse->setSettlementTypeDescription($warehouseData[self::NP_SETTLEMENT_TYPE_DESCRIPTION]);
                $warehouse->setLongitude($warehouseData[self::NP_LONGITUDE]);
                $warehouse->setLatitude($warehouseData[self::NP_LATITUDE]);
                $warehouse->setPostFinance($warehouseData[self::NP_POST_FINANCE]);
                $warehouse->setPaymentAccess($warehouseData[self::NP_PAYMENT_ACCESS]);
                $warehouse->setPosterminal($warehouseData[self::NP_POSTERMINAL]);
                $warehouse->setInternationslShipping($warehouseData[self::NP_INTERNATIONAL_SHIPPING]);
                $warehouse->setTotalMaxWeightAllowed($warehouseData[self::NP_TOTAL_MAX_WEIGHT_ALLOWED]);
                $warehouse->setPlaceMaxWeightAllowed($warehouseData[self::NP_PLACE_MAX_WEIGHT_ALLOWED]);
                $warehouse->setReception($warehouseData[self::NP_RECEPTION]);
                $warehouse->setDelivery($warehouseData[self::NP_DELIVERY]);
                $warehouse->setSchedule($warehouseData[self::NP_SCHEDULE]);
                $warehouse->setCategoryOfWarehouse($warehouseData[self::NP_CATEGORY_OF_WAREHOUSE]);
                $this->save($warehouse);
            }
            return true;
        }
        return false;
    }

    /**
     * @param $value
     * @param $field
     * @return \CodeCustom\NovaPoshta\Model\Warehouse
     */
    public function getByField($value, $field)
    {
        $object = $this->warehouseFactory->create();
        $this->warehouseResource->load($object, $value, $field);
        return $object;
    }
}
