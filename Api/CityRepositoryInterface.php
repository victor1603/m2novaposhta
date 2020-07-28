<?php

namespace CodeCustom\NovaPoshta\Api;

use CodeCustom\NovaPoshta\Api\Data\CityInterface;

interface CityRepositoryInterface
{
    const NP_DESCRIPTION                            = 'Description';
    const NP_DESCRIPTION_RU                         = 'DescriptionRu';
    const NP_REF                                    = 'Ref';
    const NP_DELIVERY_1                             = 'Delivery1';
    const NP_DELIVERY_2                             = 'Delivery2';
    const NP_DELIVERY_3                             = 'Delivery3';
    const NP_DELIVERY_4                             = 'Delivery4';
    const NP_DELIVERY_5                             = 'Delivery5';
    const NP_DELIVERY_6                             = 'Delivery6';
    const NP_DELIVERY_7                             = 'Delivery7';
    const NP_CITY_ID                                = 'CityID';
    const NP_AREA                                   = 'Area';
    const NP_SETTLEMENT_TYPE                        = 'SettlementType';
    const NP_SETTLEMENT_TYPE_DESCRIPTION            = 'SettlementTypeDescription';
    const NP_SETTLEMENT_TYPE_DESCRIPTION_RU         = 'SettlementTypeDescriptionRu';
    const NP_POSTOMAT                               = 'Postomat';
    const NP_AREA_DESCRIPTION                       = 'AreaDescription';
    const NP_AREA_DESCRIPTION_RU                    = 'AreaDescriptionRu';

    const NP_ENTITY_FIELD                           = 'city_id';

    const NP_MODEL_NAME                             = 'Address';
    const NP_CALLED_METHOD                          = 'getCities';

    /**
     * @param CityInterface $city
     * @return mixed
     */
    public function save(CityInterface $city);

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
     * @param array $cities
     * @return mixed
     */
    public function syncLoadedCities(array $cities = []);
}
