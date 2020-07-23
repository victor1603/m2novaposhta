<?php

namespace CodeCustom\NovaPoshta\Api\Data;

interface CityInterface
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
    const CITY_ID                                   = 'city_id';
    const AREA                                      = 'area';
    const SETTLEMENT_TYPE                           = 'settlement_type';
    const SETTLEMENT_TYPE_DESCRIPTION               = 'settlement_type_description';
    const SETTLEMENT_TYPE_DESCRIPTION_RU            = 'settlement_type_description_ru';
    const POSTOMAT                                  = 'postomat';
    const AREA_DESCRIPTION                          = 'area_description';
    const AREA_DESCRIPTION_RU                       = 'area_description_ru';

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
     * @param $city_id
     * @return mixed
     */
    public function setCityId($city_id);

    /**
     * @return mixed
     */
    public function getCityId();

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
     * @param $postomat
     * @return mixed
     */
    public function setPostomat($postomat);

    /**
     * @return mixed
     */
    public function getPostomat();

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
}
