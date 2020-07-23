<?php

namespace CodeCustom\NovaPoshta\Api\Data;

interface WarehouseInterface
{
    const ENTITY_ID                                 = 'entity_id';
    const SITE_KEY                                  = 'site_key';
    const DESCRIPTION                               = 'description';
    const DESCRIPTION_RU                            = 'description_ru';
    const SHORT_ADDRESS                             = 'short_address';
    const SHORT_ADDRESS_RU                          = 'short_address_ru';
    const PHONE                                     = 'phone';
    const TYPE_OF_WAREHOUSE                         = 'type_of_warehouse';
    const REF                                       = 'ref';
    const NUMBER                                    = 'number';
    const CITY_REF                                  = 'city_ref';
    const CITY_DESCRIPTION                          = 'city_description';
    const CITY_DESCRIPTION_RU                       = 'city_description_ru';
    const SETTLEMENT_REF                            = 'settlement_ref';
    const SETTLEMENT_DESCRIPTION                    = 'settlement_description';
    const SETTLEMENT_AREA_DESCRIPTION               = 'settlement_area_description';
    const SETTLEMENT_REGIONS_DESCRIPTION            = 'settlement_regions_description';
    const SETTLEMENT_TYPE_DESCRIPTION               = 'settlement_type_description';
    const LONGITUDE                                 = 'longitude';
    const LATITUDE                                  = 'latitude';
    const POST_FINANCE                              = 'post_finance';
    const PAYMENT_ACCESS                            = 'payment_access';
    const POSTERMINAL                               = 'posterminal';
    const INTERNATIONAL_SHIPPING                    = 'international_shipping';
    const TOTAL_MAX_WEIGHT_ALLOWED                  = 'total_max_weight_allowed';
    const PLACE_MAX_WEIGHT_ALLOWED                  = 'place_max_weight_allowed';
    const RECEPTION                                 = 'reception';
    const DELIVERY                                  = 'delivery';
    const SCHEDULE                                  = 'schedule';
    const CATEGORY_OF_WAREHOUSE                     = 'category_of_warehouse';

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
     * @param $site_key
     * @return mixed
     */
    public function setSiteKey($site_key);

    /**
     * @return mixed
     */
    public function getSiteKey();

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
     * @param $short_address
     * @return mixed
     */
    public function setShortAddress($short_address);

    /**
     * @return mixed
     */
    public function getShortAddress();

    /**
     * @param $short_address_ru
     * @return mixed
     */
    public function setShortAddressRu($short_address_ru);

    /**
     * @return mixed
     */
    public function getShortAddressRu();

    /**
     * @param $phone
     * @return mixed
     */
    public function setPhone($phone);

    /**
     * @return mixed
     */
    public function getPhone();

    /**
     * @param $type_of_warehouse
     * @return mixed
     */
    public function setTypeOfWarehouse($type_of_warehouse);

    /**
     * @return mixed
     */
    public function getTypeOfWarehouse();

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
     * @param $number
     * @return mixed
     */
    public function setNumber($number);

    /**
     * @return mixed
     */
    public function getNumber();

    /**
     * @param $city_ref
     * @return mixed
     */
    public function setCityRef($city_ref);

    /**
     * @return mixed
     */
    public function getCityRef();

    /**
     * @param $city_description
     * @return mixed
     */
    public function setCityDescription($city_description);

    /**
     * @return mixed
     */
    public function getCityDescription();

    /**
     * @param $city_description_ru
     * @return mixed
     */
    public function setCityDescriptionRu($city_description_ru);

    /**
     * @return mixed
     */
    public function getCityDescriptionRu();

    /**
     * @param $settlement_ref
     * @return mixed
     */
    public function setSettlementRef($settlement_ref);

    /**
     * @return mixed
     */
    public function getSettlementRef();

    /**
     * @param $settlement_description
     * @return mixed
     */
    public function setSettlementDescription($settlement_description);

    /**
     * @return mixed
     */
    public function getSettlementDescription();

    /**
     * @param $settlement_area_description
     * @return mixed
     */
    public function setSettlementAreaDescription($settlement_area_description);

    /**
     * @return mixed
     */
    public function getSettlementAreaDescription();

    /**
     * @param $settlement_regions_description
     * @return mixed
     */
    public function setSettlementRegionsDescription($settlement_regions_description);

    /**
     * @return mixed
     */
    public function getSettlementRegionsDescription();

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
     * @param $longitude
     * @return mixed
     */
    public function setLongitude($longitude);

    /**
     * @return mixed
     */
    public function getLongitude();

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
     * @param $post_finance
     * @return mixed
     */
    public function setPostFinance($post_finance);

    /**
     * @return mixed
     */
    public function getPostFinance();

    /**
     * @param $payment_access
     * @return mixed
     */
    public function setPaymentAccess($payment_access);

    /**
     * @return mixed
     */
    public function getPaymentAccess();

    /**
     * @param $posterminal
     * @return mixed
     */
    public function setPosterminal($posterminal);

    /**
     * @return mixed
     */
    public function getPosterminal();

    /**
     * @param $internationsl_shipping
     * @return mixed
     */
    public function setInternationslShipping($internationsl_shipping);

    /**
     * @return mixed
     */
    public function getInternationslShipping();

    /**
     * @param $total_max_weight_allowed
     * @return mixed
     */
    public function setTotalMaxWeightAllowed($total_max_weight_allowed);

    /**
     * @return mixed
     */
    public function getTotalMaxWeightAllowed();

    /**
     * @param $place_max_weight_allowed
     * @return mixed
     */
    public function setPlaceMaxWeightAllowed($place_max_weight_allowed);

    /**
     * @return mixed
     */
    public function getPlaceMaxWeightAllowed();

    /**
     * @param $reception
     * @return mixed
     */
    public function setReception( array $reception = []);

    /**
     * @return mixed
     */
    public function getReception();

    /**
     * @param $delivery
     * @return mixed
     */
    public function setDelivery(array $delivery = []);

    /**
     * @return mixed
     */
    public function getDelivery();

    /**
     * @param $schedule
     * @return mixed
     */
    public function setSchedule(array $schedule = []);

    /**
     * @return mixed
     */
    public function getSchedule();

    /**
     * @param $category_of_warehouse
     * @return mixed
     */
    public function setCategoryOfWarehouse($category_of_warehouse);

    /**
     * @return mixed
     */
    public function getCategoryOfWarehouse();
}
