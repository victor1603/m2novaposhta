<?php

namespace CodeCustom\NovaPoshta\Api;

use CodeCustom\NovaPoshta\Api\Data\WarehouseInterface;

interface WarehouseRepositoryInterface
{

    const NP_SITE_KEY                                  = 'SiteKey';
    const NP_DESCRIPTION                               = 'Description';
    const NP_DESCRIPTION_RU                            = 'DescriptionRu';
    const NP_SHORT_ADDRESS                             = 'ShortAddress';
    const NP_SHORT_ADDRESS_RU                          = 'ShortAddressRu';
    const NP_PHONE                                     = 'Phone';
    const NP_TYPE_OF_WAREHOUSE                         = 'TypeOfWarehouse';
    const NP_REF                                       = 'Ref';
    const NP_NUMBER                                    = 'Number';
    const NP_CITY_REF                                  = 'CityRef';
    const NP_CITY_DESCRIPTION                          = 'CityDescription';
    const NP_CITY_DESCRIPTION_RU                       = 'CityDescriptionRu';
    const NP_SETTLEMENT_REF                            = 'SettlementRef';
    const NP_SETTLEMENT_DESCRIPTION                    = 'SettlementDescription';
    const NP_SETTLEMENT_AREA_DESCRIPTION               = 'SettlementAreaDescription';
    const NP_SETTLEMENT_REGIONS_DESCRIPTION            = 'SettlementRegionsDescription';
    const NP_SETTLEMENT_TYPE_DESCRIPTION               = 'SettlementTypeDescription';
    const NP_LONGITUDE                                 = 'Longitude';
    const NP_LATITUDE                                  = 'Latitude';
    const NP_POST_FINANCE                              = 'PostFinance';
    const NP_PAYMENT_ACCESS                            = 'PaymentAccess';
    const NP_POSTERMINAL                               = 'POSTerminal';
    const NP_INTERNATIONAL_SHIPPING                    = 'InternationalShipping';
    const NP_TOTAL_MAX_WEIGHT_ALLOWED                  = 'TotalMaxWeightAllowed';
    const NP_PLACE_MAX_WEIGHT_ALLOWED                  = 'PlaceMaxWeightAllowed';
    const NP_RECEPTION                                 = 'Reception';
    const NP_DELIVERY                                  = 'Delivery';
    const NP_SCHEDULE                                  = 'Schedule';
    const NP_CATEGORY_OF_WAREHOUSE                     = 'CategoryOfWarehouse';

    const NP_ENTITY_FIELD                              = 'ref';

    const NP_MODEL_NAME                                = 'AddressGeneral';
    const NP_CALLED_METHOD                             = 'getWarehouses';

    /**
     * @param WarehouseInterface $warehouse
     * @return mixed
     */
    public function save(WarehouseInterface $warehouse);

    /**
     * @param string $cityRef
     * @return mixed
     */
    public function getList($cityRef);

    /**
     * @param string $cityRef
     * @param string $search
     * @return mixed
     */
    public function getGraphQlList($cityRef = '', $search = '');
    /**
     * @param array $warehouses
     * @return mixed
     */
    public function syncLoadedWarehouses(array $warehouses = []);
}
