<?php

namespace CodeCustom\NovaPoshta\Model\Repository;

use CodeCustom\NovaPoshta\Api\CityRepositoryInterface;
use CodeCustom\NovaPoshta\Api\Data\CityInterface;
use CodeCustom\NovaPoshta\Model\ResourceModel\City as CityResource;
use CodeCustom\NovaPoshta\Model\CityFactory;
use CodeCustom\NovaPoshta\Model\ResourceModel\City\CollectionFactory as CityCollectionFactory;

class City implements CityRepositoryInterface
{
    /**
     * @var CityResource
     */
    protected $cityResource;

    /**
     * @var CityFactory
     */
    protected $cityFactory;

    /**
     * @var CityCollectionFactory
     */
    protected $cityCollectionFactory;

    public function __construct(
        CityResource $cityResource,
        CityFactory $cityFactory,
        CityCollectionFactory $cityCollectionFactory
    )
    {
        $this->cityResource = $cityResource;
        $this->cityFactory = $cityFactory;
        $this->cityCollectionFactory = $cityCollectionFactory;
    }

    /**
     * @param CityInterface $city
     * @return mixed|void
     */
    public function save(CityInterface $city)
    {
        try {
            $this->cityResource->save($city);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__('Could not save Source'), $exception);
        }
    }

    /**
     * @param array $params
     * @return array|mixed
     */
    public function getList(array $params = [])
    {
        $collection = $this->cityCollectionFactory->create();
        $data[] = ['label' => __('Choose city'), 'value' => 0];

        if ($collection && $collection->getSize()) {
            foreach ($collection->getItems() as $item) {
                $data[] = ['label' => $item->getDescriptionRu(), 'value' => $item->getRef()];
            }
        }
        return json_encode($data);
    }

    /**
     * @param array $params
     * @return array|mixed
     */
    public function getGraphQlList(array $params = [])
    {
        $collection = $this->cityCollectionFactory->create();

        if (!empty($params)) {
            foreach ($params as $key => $value) {
                $collection->addFieldToFilter(
                    [$key],
                    [
                        ['like' => '%' . $value . '%'],
                    ]
                );
            }
        }

        $data[] = ['name' => __('Choose city'), 'ref' => 0];

        if ($collection && $collection->getSize()) {
            foreach ($collection->getItems() as $item) {
                $data[] = ['name' => $item->getDescriptionRu(), 'ref' => $item->getRef()];
            }
        }
        return $data;
    }

    /**
     * @param array $cities
     * @return bool|mixed
     */
    public function syncLoadedCities(array $cities = [])
    {
        if (!empty($cities)) {
            foreach ($cities as $cityData) {
                $city = $this->getByField($cityData[self::NP_CITY_ID], self::NP_ENTITY_FIELD);
                $city->setDescription($cityData[self::NP_DESCRIPTION]);
                $city->setDescriptionRu($cityData[self::NP_DESCRIPTION_RU]);
                $city->setRef($cityData[self::NP_REF]);
                $city->setDelivery1($cityData[self::NP_DELIVERY_1]);
                $city->setDelivery2($cityData[self::NP_DELIVERY_2]);
                $city->setDelivery3($cityData[self::NP_DELIVERY_3]);
                $city->setDelivery4($cityData[self::NP_DELIVERY_4]);
                $city->setDelivery5($cityData[self::NP_DELIVERY_5]);
                $city->setDelivery6($cityData[self::NP_DELIVERY_6]);
                $city->setDelivery7($cityData[self::NP_DELIVERY_7]);
                $city->setCityId($cityData[self::NP_CITY_ID]);
                $city->setArea($cityData[self::NP_AREA]);
                $city->setSettlementType($cityData[self::NP_SETTLEMENT_TYPE]);
                $city->setSettlementTypeDescription($cityData[self::NP_SETTLEMENT_TYPE_DESCRIPTION]);
                $city->setSettlementTypeDescriptionRu($cityData[self::NP_SETTLEMENT_TYPE_DESCRIPTION_RU]);
                $city->setAreaDescription($cityData[self::NP_AREA_DESCRIPTION]);
                $city->setAreaDescriptionRu($cityData[self::NP_AREA_DESCRIPTION_RU]);
                $this->save($city);
            }
            return true;
        }
        return false;
    }

    /**
     * @param $value
     * @param $field
     * @return \CodeCustom\NovaPoshta\Model\City
     */
    public function getByField($value, $field)
    {
        $object = $this->cityFactory->create();
        $this->cityResource->load($object, $value, $field);
        return $object;
    }

}
