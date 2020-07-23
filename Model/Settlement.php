<?php

namespace CodeCustom\NovaPoshta\Model;

use CodeCustom\NovaPoshta\Api\Data\SettlementInterface;
use Magento\Framework\Model\AbstractModel;
use CodeCustom\NovaPoshta\Model\ResourceModel\Settlement as SettlementResource;

class Settlement extends AbstractModel implements SettlementInterface
{
    public function _construct()
    {
        $this->_init(SettlementResource::class);
    }

    /**
     * @param int $entity_id
     * @return City|mixed|void
     */
    public function setEntityId($entity_id)
    {
        $this->setData(self::ENTITY_ID, $entity_id);
    }

    /**
     * @return array|mixed|null
     */
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * @param $description
     * @return mixed|void
     */
    public function setDescription($description)
    {
        $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * @return array|mixed|null
     */
    public function getDescription()
    {
        return $this->getData(self::DESCRIPTION);
    }

    /**
     * @param $description_ru
     * @return mixed|void
     */
    public function setDescriptionRu($description_ru)
    {
        $this->setData(self::DESCRIPTION_RU, $description_ru);
    }

    /**
     * @return array|mixed|null
     */
    public function getDescriptionRu()
    {
        return $this->getData(self::DESCRIPTION_RU);
    }

    /**
     * @param $ref
     * @return mixed|void
     */
    public function setRef($ref)
    {
        $this->setData(self::REF, $ref);
    }

    /**
     * @return array|mixed|null
     */
    public function getRef()
    {
        return $this->getData(self::REF);
    }

    /**
     * @param $delivery_1
     * @return mixed|void
     */
    public function setDelivery1($delivery_1)
    {
        $this->setData(self::DELIVERY_1, $delivery_1);
    }

    /**
     * @return array|mixed|null
     */
    public function getDelivery1()
    {
        return $this->getData(self::DELIVERY_1);
    }

    /**
     * @param $delivery_2
     * @return mixed|void
     */
    public function setDelivery2($delivery_2)
    {
        $this->setData(self::DELIVERY_2, $delivery_2);
    }

    /**
     * @return array|mixed|null
     */
    public function getDelivery2()
    {
        return $this->getData(self::DELIVERY_2);
    }

    /**
     * @param $delivery_3
     * @return mixed|void
     */
    public function setDelivery3($delivery_3)
    {
        $this->setData(self::DELIVERY_3, $delivery_3);
    }

    /**
     * @return array|mixed|null
     */
    public function getDelivery3()
    {
        return $this->getData(self::DELIVERY_3);
    }

    /**
     * @param $delivery_4
     * @return mixed|void
     */
    public function setDelivery4($delivery_4)
    {
        $this->setData(self::DELIVERY_4, $delivery_4);
    }

    /**
     * @return array|mixed|null
     */
    public function getDelivery4()
    {
        return $this->getData(self::DELIVERY_4);
    }

    /**
     * @param $delivery_5
     * @return mixed|void
     */
    public function setDelivery5($delivery_5)
    {
        $this->setData(self::DELIVERY_5, $delivery_5);
    }

    /**
     * @return array|mixed|null
     */
    public function getDelivery5()
    {
        return $this->getData(self::DELIVERY_5);
    }

    /**
     * @param $delivery_6
     * @return mixed|void
     */
    public function setDelivery6($delivery_6)
    {
        $this->setData(self::DELIVERY_6, $delivery_6);
    }

    /**
     * @return array|mixed|null
     */
    public function getDelivery6()
    {
        return $this->getData(self::DELIVERY_6);
    }

    /**
     * @param $delivery_7
     * @return mixed|void
     */
    public function setDelivery7($delivery_7)
    {
        $this->setData(self::DELIVERY_7, $delivery_7);
    }

    /**
     * @return array|mixed|null
     */
    public function getDelivery7()
    {
        return $this->getData(self::DELIVERY_7);
    }

    /**
     * @param $area
     * @return mixed|void
     */
    public function setArea($area)
    {
        $this->setData(self::AREA, $area);
    }

    /**
     * @return array|mixed|null
     */
    public function getArea()
    {
        return $this->getData(self::AREA);
    }

    /**
     * @param $area_description
     * @return mixed|void
     */
    public function setAreaDescription($area_description)
    {
        $this->setData(self::AREA_DESCRIPTION, $area_description);
    }

    /**
     * @return array|mixed|null
     */
    public function getAreaDescription()
    {
        return $this->getData(self::AREA_DESCRIPTION);
    }

    /**
     * @param $area_description_ru
     * @return mixed|void
     */
    public function setAreaDescriptionRu($area_description_ru)
    {
        $this->setData(self::AREA_DESCRIPTION_RU, $area_description_ru);
    }

    /**
     * @return array|mixed|null
     */
    public function getAreaDescriptionRu()
    {
        return $this->getData(self::AREA_DESCRIPTION_RU);
    }

    /**
     * @param $settlement_type
     * @return mixed|void
     */
    public function setSettlementType($settlement_type)
    {
        $this->setData(self::SETTLEMENT_TYPE, $settlement_type);
    }

    /**
     * @return array|mixed|null
     */
    public function getSettlementType()
    {
        return $this->getData(self::SETTLEMENT_TYPE);
    }

    /**
     * @param $settlement_type_description
     * @return mixed|void
     */
    public function setSettlementTypeDescription($settlement_type_description)
    {
        $this->setData(self::SETTLEMENT_TYPE_DESCRIPTION, $settlement_type_description);
    }

    /**
     * @return array|mixed|null
     */
    public function getSettlementTypeDescription()
    {
        return $this->getData(self::SETTLEMENT_TYPE_DESCRIPTION);
    }

    /**
     * @param $settlement_type_description_ru
     * @return mixed|void
     */
    public function setSettlementTypeDescriptionRu($settlement_type_description_ru)
    {
        $this->setData(self::SETTLEMENT_TYPE_DESCRIPTION_RU, $settlement_type_description_ru);
    }

    /**
     * @return array|mixed|null
     */
    public function getSettlementTypeDescriptionRu()
    {
        return $this->getData(self::SETTLEMENT_TYPE_DESCRIPTION_RU);
    }

    /**
     * @param $latitude
     * @return mixed|void
     */
    public function setLatitude($latitude)
    {
        $this->setData(self::LATITUDE, $latitude);
    }

    /**
     * @return array|mixed|null
     */
    public function getLatitude()
    {
        return $this->getData(self::LATITUDE);
    }

    /**
     * @param $longitude
     * @return mixed|void
     */
    public function setLongitude($longitude)
    {
        $this->setData(self::LONGITUDE, $longitude);
    }

    /**
     * @return array|mixed|null
     */
    public function getLongitude()
    {
        return $this->getData(self::LONGITUDE);
    }

    /**
     * @param $region
     * @return mixed|void
     */
    public function setRegion($region)
    {
        $this->setData(self::REGION, $region);
    }

    /**
     * @return array|mixed|null
     */
    public function getRegion()
    {
        return $this->getData(self::REGION);
    }

    /**
     * @param $regions_description
     * @return mixed|void
     */
    public function setRegionsDescription($regions_description)
    {
        $this->setData(self::REGIONS_DESCRIPTION, $regions_description);
    }

    /**
     * @return array|mixed|null
     */
    public function getRegionsDescription()
    {
        return $this->getData(self::REGIONS_DESCRIPTION);
    }

    /**
     * @param $regions_description_ru
     * @return mixed|void
     */
    public function setRegionsDescriptionRu($regions_description_ru)
    {
        $this->setData(self::REGIONS_DESCRIPTION_RU, $regions_description_ru);
    }

    /**
     * @return array|mixed|null
     */
    public function getRegionsDescriptionRu()
    {
        return $this->getData(self::REGIONS_DESCRIPTION_RU);
    }

    /**
     * @param $index_1
     * @return mixed|void
     */
    public function setIndex1($index_1)
    {
        $this->setData(self::INDEX_1, $index_1);
    }

    /**
     * @return array|mixed|null
     */
    public function getIndex1()
    {
        return $this->getData(self::INDEX_1);
    }

    /**
     * @param $index_2
     * @return mixed|void
     */
    public function setIndex2($index_2)
    {
        $this->setData(self::INDEX_2, $index_2);
    }

    /**
     * @return array|mixed|null
     */
    public function getIndex2()
    {
        return $this->getData(self::INDEX_2);
    }

    /**
     * @param $index_coatsu_1
     * @return mixed|void
     */
    public function setIndexCoatsu1($index_coatsu_1)
    {
        $this->setData(self::INDEX_COATSU_1, $index_coatsu_1);
    }

    /**
     * @return array|mixed|null
     */
    public function getIndexCoatsu1()
    {
        return $this->getData(self::INDEX_COATSU_1);
    }

    /**
     * @param $special_cash_check
     * @return mixed|void
     */
    public function setSpecialCashCheck($special_cash_check)
    {
        $this->setData(self::SPECIAL_CASH_CHECK, $special_cash_check);
    }

    /**
     * @return array|mixed|null
     */
    public function getSpecialCashCheck()
    {
        return $this->getData(self::SPECIAL_CASH_CHECK);
    }

    /**
     * @param $warehouse
     * @return \CodeCustom\NovaPoshta\Api\Data\mixe|void
     */
    public function setWarehouse($warehouse)
    {
        $this->setData(self::WAREHOUSE, $warehouse);
    }

    /**
     * @return array|mixed|null
     */
    public function getWarehouse()
    {
        return $this->getData(self::WAREHOUSE);
    }

}
