<?php

namespace CodeCustom\NovaPoshta\Model;

use CodeCustom\NovaPoshta\Api\Data\CityInterface;
use Magento\Framework\Model\AbstractModel;

class City extends AbstractModel implements CityInterface
{
    public function _construct()
    {
        $this->_init(\CodeCustom\NovaPoshta\Model\ResourceModel\City::class);
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
     * @param $city_id
     * @return mixed|void
     */
    public function setCityId($city_id)
    {
        $this->setData(self::CITY_ID, $city_id);
    }

    /**
     * @return array|mixed|null
     */
    public function getCityId()
    {
        return $this->getData(self::CITY_ID);
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
     * @param $postomat
     * @return mixed|void
     */
    public function setPostomat($postomat)
    {
        $this->setData(self::POSTOMAT, $postomat);
    }

    /**
     * @return array|mixed|null
     */
    public function getPostomat()
    {
        return $this->getData(self::POSTOMAT);
    }
}
