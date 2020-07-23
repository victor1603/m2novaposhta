<?php

namespace CodeCustom\NovaPoshta\Api\Data;

interface SettlementInterface
{
    const ENTITY_ID                                 = 'entity_id';
    const DESCRIPTION                               = 'description';
    const DESCRIPTION_RU                            = 'description_ru';
    const REF                                       = 'ref';
    const DELIVERY_1                                = 'delivery_1';
    const DELIVERY_2                                = 'delivery_2';
    const DELIVERY_3                                = 'delivery_3';
    const DELIVERY_4                                = 'delivery_4';
    const DELIVERY_5                                = 'delivery_5';
    const DELIVERY_6                                = 'delivery_6';
    const DELIVERY_7                                = 'delivery_7';
    const AREA                                      = 'area';
    const AREA_DESCRIPTION                          = 'area_description';
    const AREA_DESCRIPTION_RU                       = 'area_description_ru';
    const SETTLEMENT_TYPE                           = 'settlement_type';
    const SETTLEMENT_TYPE_DESCRIPTION               = 'settlement_type_description';
    const SETTLEMENT_TYPE_DESCRIPTION_RU            = 'settlement_type_description_ru';
    const LATITUDE                                  = 'latitude';
    const LONGITUDE                                 = 'longitude';
    const REGION                                    = 'region';
    const REGIONS_DESCRIPTION                       = 'regions_description';
    const REGIONS_DESCRIPTION_RU                    = 'regions_description_ru';
    const INDEX_1                                   = 'index_1';
    const INDEX_2                                   = 'index_2';
    const INDEX_COATSU_1                            = 'index_coatsu_1';
    const SPECIAL_CASH_CHECK                        = 'special_cash_check';
    const WAREHOUSE                                 = 'warehouse';


    /**
     * @param $entity_id
     * @return mixed
     */
    public function setEntityId($entity_id);

    /**
     * @return mixed
     */
    public function getEntityId();

    /**
     * @param $description
     * @return mixed
     */
    public function setDescription($description);

    /**
     * @return mixed
     */
    public function getDescription();

    /**
     * @param $description_ru
     * @return mixed
     */
    public function setDescriptionRu($description_ru);

    /**
     * @return mixed
     */
    public function getDescriptionRu();

    /**
     * @param $ref
     * @return mixed
     */
    public function setRef($ref);

    /**
     * @return mixed
     */
    public function getRef();

    /**
     * @param $delivery_1
     * @return mixed
     */
    public function setDelivery1($delivery_1);

    /**
     * @return mixed
     */
    public function getDelivery1();

    /**
     * @param $delivery_2
     * @return mixed
     */
    public function setDelivery2($delivery_2);

    /**
     * @return mixed
     */
    public function getDelivery2();

    /**
     * @param $delivery_3
     * @return mixed
     */
    public function setDelivery3($delivery_3);

    /**
     * @return mixed
     */
    public function getDelivery3();

    /**
     * @param $delivery_4
     * @return mixed
     */
    public function setDelivery4($delivery_4);

    /**
     * @return mixed
     */
    public function getDelivery4();

    /**
     * @param $delivery_5
     * @return mixed
     */
    public function setDelivery5($delivery_5);

    /**
     * @return mixed
     */
    public function getDelivery5();

    /**
     * @param $delivery_6
     * @return mixed
     */
    public function setDelivery6($delivery_6);

    /**
     * @return mixed
     */
    public function getDelivery6();

    /**
     * @param $delivery_7
     * @return mixed
     */
    public function setDelivery7($delivery_7);

    /**
     * @return mixed
     */
    public function getDelivery7();

    /**
     * @param $area
     * @return mixed
     */
    public function setArea($area);

    /**
     * @return mixed
     */
    public function getArea();

    /**
     * @param $area_description
     * @return mixed
     */
    public function setAreaDescription($area_description);

    /**
     * @return mixed
     */
    public function getAreaDescription();

    /**
     * @param $area_description_ru
     * @return mixed
     */
    public function setAreaDescriptionRu($area_description_ru);

    /**
     * @return mixed
     */
    public function getAreaDescriptionRu();

    /**
     * @param $settlement_type
     * @return mixed
     */
    public function setSettlementType($settlement_type);

    /**
     * @return mixed
     */
    public function getSettlementType();

    /**
     * @param $settlement_type_description
     * @return mixed
     */
    public function setSettlementTypeDescription($settlement_type_description);

    /**
     * @return mixed
     */
    public function getSettlementTypeDescription();

    /**
     * @param $settlement_type_description_ru
     * @return mixed
     */
    public function setSettlementTypeDescriptionRu($settlement_type_description_ru);

    /**
     * @return mixed
     */
    public function getSettlementTypeDescriptionRu();

    /**
     * @param $latitude
     * @return mixed
     */
    public function setLatitude($latitude);

    /**
     * @return mixed
     */
    public function getLatitude();

    /**
     * @param $longitude
     * @return mixed
     */
    public function setLongitude($longitude);

    /**
     * @return mixed
     */
    public function getLongitude();

    /**
     * @param $region
     * @return mixed
     */
    public function setRegion($region);

    /**
     * @return mixed
     */
    public function getRegion();

    /**
     * @param $regions_description
     * @return mixed
     */
    public function setRegionsDescription($regions_description);

    /**
     * @return mixed
     */
    public function getRegionsDescription();

    /**
     * @param $regions_description_ru
     * @return mixed
     */
    public function setRegionsDescriptionRu($regions_description_ru);

    /**
     * @return mixed
     */
    public function getRegionsDescriptionRu();

    /**
     * @param $index_1
     * @return mixed
     */
    public function setIndex1($index_1);

    /**
     * @return mixed
     */
    public function getIndex1();

    /**
     * @param $index_2
     * @return mixed
     */
    public function setIndex2($index_2);

    /**
     * @return mixed
     */
    public function getIndex2();

    /**
     * @param $index_coatsu_1
     * @return mixed
     */
    public function setIndexCoatsu1($index_coatsu_1);

    /**
     * @return mixed
     */
    public function getIndexCoatsu1();

    /**
     * @param $special_cash_check
     * @return mixed
     */
    public function setSpecialCashCheck($special_cash_check);

    /**
     * @return mixed
     */
    public function getSpecialCashCheck();

    /**
     * @param $warehouse
     * @return mixe
     */
    public function setWarehouse($warehouse);

    /**
     * @return mixed
     */
    public function getWarehouse();

}
