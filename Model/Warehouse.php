<?php

namespace CodeCustom\NovaPoshta\Model;

use CodeCustom\NovaPoshta\Api\Data\WarehouseInterface;
use Magento\Framework\Model\AbstractModel;
use CodeCustom\NovaPoshta\Model\ResourceModel\Warehouse as WarehouseResource;

class Warehouse extends AbstractModel implements WarehouseInterface
{

    public function _construct()
    {
        $this->_init(WarehouseResource::class);
    }

    /**
     * @param int $entity_id
     * @return Warehouse|mixed|void
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
     * @param $site_key
     * @return mixed|void
     */
    public function setSiteKey($site_key)
    {
        $this->setData(self::SITE_KEY, $site_key);
    }

    /**
     * @return array|mixed|null
     */
    public function getSiteKey()
    {
        return $this->getData(self::SITE_KEY);
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
     * @param $short_address
     * @return mixed|void
     */
    public function setShortAddress($short_address)
    {
        $this->setData(self::SHORT_ADDRESS, $short_address);
    }

    /**
     * @return array|mixed|null
     */
    public function getShortAddress()
    {
        return $this->getData(self::SHORT_ADDRESS);
    }

    /**
     * @param $short_address_ru
     * @return mixed|void
     */
    public function setShortAddressRu($short_address_ru)
    {
        $this->setData(self::SHORT_ADDRESS_RU, $short_address_ru);
    }

    /**
     * @return array|mixed|null
     */
    public function getShortAddressRu()
    {
        return $this->getData(self::SHORT_ADDRESS_RU);
    }

    /**
     * @param $phone
     * @return mixed|void
     */
    public function setPhone($phone)
    {
        $this->setData(self::PHONE, $phone);
    }

    /**
     * @return array|mixed|null
     */
    public function getPhone()
    {
        return $this->getData(self::PHONE);
    }

    /**
     * @param $type_of_warehouse
     * @return mixed|void
     */
    public function setTypeOfWarehouse($type_of_warehouse)
    {
        $this->setData(self::TYPE_OF_WAREHOUSE, $type_of_warehouse);
    }

    /**
     * @return array|mixed|null
     */
    public function getTypeOfWarehouse()
    {
        return $this->getData(self::TYPE_OF_WAREHOUSE);
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
     * @param $number
     * @return mixed|void
     */
    public function setNumber($number)
    {
        $this->setData(self::NUMBER, $number);
    }

    /**
     * @return array|mixed|null
     */
    public function getNumber()
    {
        return $this->getData(self::NUMBER);
    }

    /**
     * @param $city_ref
     * @return mixed|void
     */
    public function setCityRef($city_ref)
    {
        $this->setData(self::CITY_REF, $city_ref);
    }

    /**
     * @return array|mixed|null
     */
    public function getCityRef()
    {
        return $this->getData(self::CITY_REF);
    }

    /**
     * @param $city_description
     * @return mixed|void
     */
    public function setCityDescription($city_description)
    {
        $this->setData(self::CITY_DESCRIPTION, $city_description);
    }

    /**
     * @return array|mixed|null
     */
    public function getCityDescription()
    {
        return $this->getData(self::CITY_DESCRIPTION);
    }

    /**
     * @param $city_description_ru
     * @return mixed|void
     */
    public function setCityDescriptionRu($city_description_ru)
    {
        $this->setData(self::CITY_DESCRIPTION_RU, $city_description_ru);
    }

    /**
     * @return array|mixed|null
     */
    public function getCityDescriptionRu()
    {
        return $this->getData(self::CITY_DESCRIPTION_RU);
    }

    /**
     * @param $settlement_ref
     * @return mixed|void
     */
    public function setSettlementRef($settlement_ref)
    {
        $this->setData(self::SETTLEMENT_REF, $settlement_ref);
    }

    /**
     * @return array|mixed|null
     */
    public function getSettlementRef()
    {
        return $this->getData(self::SETTLEMENT_REF);
    }

    /**
     * @param $settlement_description
     * @return mixed|void
     */
    public function setSettlementDescription($settlement_description)
    {
        $this->setData(self::SETTLEMENT_DESCRIPTION, $settlement_description);
    }

    /**
     * @return array|mixed|null
     */
    public function getSettlementDescription()
    {
        return $this->getData(self::SETTLEMENT_DESCRIPTION);
    }

    /**
     * @param $settlement_area_description
     * @return mixed|void
     */
    public function setSettlementAreaDescription($settlement_area_description)
    {
        $this->setData(self::SETTLEMENT_AREA_DESCRIPTION, $settlement_area_description);
    }

    /**
     * @return array|mixed|null
     */
    public function getSettlementAreaDescription()
    {
        return $this->getData(self::SETTLEMENT_AREA_DESCRIPTION);
    }

    /**
     * @param $settlement_regions_description
     * @return mixed|void
     */
    public function setSettlementRegionsDescription($settlement_regions_description)
    {
        $this->setData(self::SETTLEMENT_REGIONS_DESCRIPTION, $settlement_regions_description);
    }

    /**
     * @return array|mixed|null
     */
    public function getSettlementRegionsDescription()
    {
        return $this->getData(self::SETTLEMENT_REGIONS_DESCRIPTION);
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
     * @param $post_finance
     * @return mixed|void
     */
    public function setPostFinance($post_finance)
    {
        $this->setData(self::POST_FINANCE, $post_finance);
    }

    /**
     * @return array|mixed|null
     */
    public function getPostFinance()
    {
        return $this->getData(self::POST_FINANCE);
    }

    /**
     * @param $payment_access
     * @return mixed|void
     */
    public function setPaymentAccess($payment_access)
    {
        $this->setData(self::PAYMENT_ACCESS, $payment_access);
    }

    /**
     * @return array|mixed|null
     */
    public function getPaymentAccess()
    {
        return $this->getData(self::PAYMENT_ACCESS);
    }

    /**
     * @param $posterminal
     * @return mixed|void
     */
    public function setPosterminal($posterminal)
    {
        $this->setData(self::POSTERMINAL, $posterminal);
    }

    /**
     * @return array|mixed|null
     */
    public function getPosterminal()
    {
        return $this->getData(self::POSTERMINAL);
    }

    /**
     * @param $internationsl_shipping
     * @return mixed|void
     */
    public function setInternationslShipping($internationsl_shipping)
    {
        $this->setData(self::INTERNATIONAL_SHIPPING, $internationsl_shipping);
    }

    /**
     * @return array|mixed|null
     */
    public function getInternationslShipping()
    {
        return $this->getData(self::INTERNATIONAL_SHIPPING);
    }

    /**
     * @param $total_max_weight_allowed
     * @return mixed|void
     */
    public function setTotalMaxWeightAllowed($total_max_weight_allowed)
    {
        $this->setData(self::TOTAL_MAX_WEIGHT_ALLOWED, $total_max_weight_allowed);
    }

    /**
     * @return array|mixed|null
     */
    public function getTotalMaxWeightAllowed()
    {
        return $this->getData(self::TOTAL_MAX_WEIGHT_ALLOWED);
    }

    /**
     * @param $place_max_weight_allowed
     * @return mixed|void
     */
    public function setPlaceMaxWeightAllowed($place_max_weight_allowed)
    {
        $this->setData(self::PLACE_MAX_WEIGHT_ALLOWED, $place_max_weight_allowed);
    }

    /**
     * @return array|mixed|null
     */
    public function getPlaceMaxWeightAllowed()
    {
        return $this->getData(self::PLACE_MAX_WEIGHT_ALLOWED);
    }

    /**
     * @param $reception
     * @return mixed|void
     */
    public function setReception(array $reception = [])
    {
        $this->setData(self::RECEPTION, is_array($reception) ? serialize($reception) : $reception);
    }

    /**
     * @return array|mixed|null
     */
    public function getReception()
    {
        return $this->getData(self::RECEPTION);
    }

    /**
     * @param $delivery
     * @return mixed|void
     */
    public function setDelivery(array $delivery = [])
    {
        $this->setData(self::DELIVERY, is_array($delivery) ? serialize($delivery) : $delivery);
    }

    /**
     * @return array|mixed|null
     */
    public function getDelivery()
    {
        return $this->getData(self::DELIVERY);
    }

    /**
     * @param $schedule
     * @return mixed|void
     */
    public function setSchedule(array $schedule = [])
    {
        $this->setData(self::SCHEDULE, is_array($schedule) ? serialize($schedule) : $schedule);
    }

    /**
     * @return array|mixed|null
     */
    public function getSchedule()
    {
        return $this->getData(self::SCHEDULE);
    }

    /**
     * @param $category_of_warehouse
     * @return mixed|void
     */
    public function setCategoryOfWarehouse($category_of_warehouse)
    {
        $this->setData(self::CATEGORY_OF_WAREHOUSE, $category_of_warehouse);
    }

    /**
     * @return array|mixed|null
     */
    public function getCategoryOfWarehouse()
    {
        return $this->getData(self::CATEGORY_OF_WAREHOUSE);
    }
}
