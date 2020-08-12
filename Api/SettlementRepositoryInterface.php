<?php

namespace CodeCustom\NovaPoshta\Api;

use CodeCustom\NovaPoshta\Api\Data\SettlementInterface;

interface SettlementRepositoryInterface
{
    const NP_DESCRIPTION                               = 'Description';
    const NP_DESCRIPTION_RU                            = 'DescriptionRu';
    const NP_REF                                       = 'Ref';
    const NP_DELIVERY_1                                = 'Delivery1';
    const NP_DELIVERY_2                                = 'Delivery2';
    const NP_DELIVERY_3                                = 'Delivery3';
    const NP_DELIVERY_4                                = 'Delivery4';
    const NP_DELIVERY_5                                = 'Delivery5';
    const NP_DELIVERY_6                                = 'Delivery6';
    const NP_DELIVERY_7                                = 'Delivery7';
    const NP_AREA                                      = 'Area';
    const NP_AREA_DESCRIPTION                          = 'AreaDescription';
    const NP_AREA_DESCRIPTION_RU                       = 'AreaDescriptionRu';
    const NP_SETTLEMENT_TYPE                           = 'SettlementType';
    const NP_SETTLEMENT_TYPE_DESCRIPTION               = 'SettlementTypeDescription';
    const NP_SETTLEMENT_TYPE_DESCRIPTION_RU            = 'SettlementTypeDescriptionRu';
    const NP_LATITUDE                                  = 'Latitude';
    const NP_LONGITUDE                                 = 'Longitude';
    const NP_REGION                                    = 'Region';
    const NP_REGIONS_DESCRIPTION                       = 'RegionsDescription';
    const NP_REGIONS_DESCRIPTION_RU                    = 'RegionsDescriptionRu';
    const NP_INDEX_1                                   = 'Index1';
    const NP_INDEX_2                                   = 'Index2';
    const NP_INDEX_COATSU_1                            = 'IndexCOATSU1';
    const NP_SPECIAL_CASH_CHECK                        = 'SpecialCashCheck';
    const NP_WAREHOUSE                                 = 'Warehouse';

    const NP_ENTITY_FIELD                              = 'ref';

    const NP_MODEL_NAME                                = 'AddressGeneral';
    const NP_CALLED_METHOD                             = 'getSettlements';

    /**
     * @param SettlementInterface $settlement
     * @return mixed
     */
    public function save(SettlementInterface $settlement);

    /**
     * @param string $name
     * @return mixed
     */
    public function getList(string $name = '');

    /**
     * @param array $params
     * @return mixed
     */
    public function getGraphQlList(array $params = []);

    /**
     * @param array $settlements
     * @return mixed
     */
    public function syncLoadedSettlements(array $settlements = []);
}
