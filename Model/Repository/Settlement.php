<?php

namespace CodeCustom\NovaPoshta\Model\Repository;

use CodeCustom\NovaPoshta\Api\Data\SettlementInterface;
use CodeCustom\NovaPoshta\Api\SettlementRepositoryInterface;
use CodeCustom\NovaPoshta\Model\ResourceModel\Settlement as SettlementResource;
use CodeCustom\NovaPoshta\Model\SettlementFactory;

class Settlement implements SettlementRepositoryInterface
{
    /**
     * @var SettlementResource
     */
    protected $settlementResource;

    /**
     * @var SettlementFactory
     */
    protected $settlementFactory;

    public function __construct(
        SettlementResource $settlementResource,
        SettlementFactory $settlementFactory
    )
    {
        $this->settlementResource = $settlementResource;
        $this->settlementFactory = $settlementFactory;
    }

    /**
     * @param SettlementInterface $settlement
     * @return mixed|void
     */
    public function save(SettlementInterface $settlement)
    {
        try {
            $this->settlementResource->save($settlement);
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
        return [];
    }

    /**
     * @param array $settlements
     * @return bool|mixed
     */
    public function syncLoadedSettlements(array $settlements = [])
    {
        if (!empty($settlements)) {
            foreach ($settlements as $settlementData) {
                $settlement = $this->getByField($settlementData[self::NP_REF], self::NP_ENTITY_FIELD);
                $settlement->setDescription($settlementData[self::NP_DESCRIPTION]);
                $settlement->setDescriptionRu($settlementData[self::NP_DESCRIPTION_RU]);
                $settlement->setRef($settlementData[self::NP_REF]);
                $settlement->setDelivery1($settlementData[self::NP_DELIVERY_1]);
                $settlement->setDelivery2($settlementData[self::NP_DELIVERY_2]);
                $settlement->setDelivery3($settlementData[self::NP_DELIVERY_3]);
                $settlement->setDelivery4($settlementData[self::NP_DELIVERY_4]);
                $settlement->setDelivery5($settlementData[self::NP_DELIVERY_5]);
                $settlement->setDelivery6($settlementData[self::NP_DELIVERY_6]);
                $settlement->setDelivery7($settlementData[self::NP_DELIVERY_7]);
                $settlement->setArea($settlementData[self::NP_AREA]);
                $settlement->setAreaDescription($settlementData[self::NP_AREA_DESCRIPTION]);
                $settlement->setAreaDescriptionRu($settlementData[self::NP_AREA_DESCRIPTION_RU]);
                $settlement->setSettlementType($settlementData[self::NP_SETTLEMENT_TYPE]);
                $settlement->setSettlementTypeDescription($settlementData[self::NP_SETTLEMENT_TYPE_DESCRIPTION]);
                $settlement->setSettlementTypeDescriptionRu($settlementData[self::NP_SETTLEMENT_TYPE_DESCRIPTION_RU]);
                $settlement->setLatitude($settlementData[self::NP_LATITUDE]);
                $settlement->setLongitude($settlementData[self::NP_LONGITUDE]);
                $settlement->setRegion($settlementData[self::NP_REGION]);
                $settlement->setRegionsDescription($settlementData[self::NP_REGIONS_DESCRIPTION]);
                $settlement->setRegionsDescriptionRu($settlementData[self::NP_REGIONS_DESCRIPTION_RU]);
                $settlement->setIndex1($settlementData[self::NP_INDEX_1]);
                $settlement->setIndex2($settlementData[self::NP_INDEX_2]);
                $settlement->setIndexCoatsu1($settlementData[self::NP_INDEX_COATSU_1]);
                $settlement->setSpecialCashCheck($settlementData[self::NP_SPECIAL_CASH_CHECK]);
                $settlement->setWarehouse($settlementData[self::NP_WAREHOUSE]);
                $this->save($settlement);
            }

            return true;
        }
        return false;
    }

    /**
     * @param $value
     * @param $field
     * @return \CodeCustom\NovaPoshta\Model\Settlement
     */
    public function getByField($value, $field)
    {
        $object = $this->settlementFactory->create();
        $this->settlementResource->load($object, $value, $field);
        return $object;
    }
}
