<?php

namespace CodeCustom\NovaPoshta\Model\Resolver\ShippingAddress;

use CodeCustom\NovaPoshta\Api\SettlementRepositoryInterface;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use CodeCustom\NovaPoshta\Model\Carrier\NovaPoshtaWarehouse;
use CodeCustom\NovaPoshta\Model\Carrier\NovaPoshtaAddress;
use CodeCustom\NovaPoshta\Model\Carrier\NovaPoshtaKiev;
use CodeCustom\NovaPoshta\Model\Carrier\KievStandard;
use CodeCustom\NovaPoshta\Model\Carrier\KievSuburb;
use CodeCustom\NovaPoshta\Model\Carrier\KievFast;
use CodeCustom\NovaPoshta\Api\CityRepositoryInterface;
use CodeCustom\NovaPoshta\Api\WarehouseRepositoryInterface;

class SelectedShippingMethod implements ResolverInterface
{

    protected $cityRepository;

    protected $settlementRepository;

    protected $warehouseRepository;

    protected $oneCityTitle = "kiev";

    public function __construct(
        CityRepositoryInterface $cityRepository,
        SettlementRepositoryInterface $settlementRepository,
        WarehouseRepositoryInterface $warehouseRepository
    )
    {
        $this->cityRepository = $cityRepository;
        $this->settlementRepository = $settlementRepository;
        $this->warehouseRepository = $warehouseRepository;
    }

    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $method_code = isset($value['method_code']) ? $value['method_code'] : null;
        $kievCityRef = $this->cityRepository->getElementKey($this->oneCityTitle);
        $kievSettlementRef = $this->settlementRepository->getElementKey($this->oneCityTitle);
        return [
            'city_view' => $this->getCityView($method_code, $kievCityRef, $kievSettlementRef),
            'warehouse_view' => $this->getWarehouseView($method_code, $kievCityRef),
            'street_view' => $this->getStreetView($method_code)
        ];
    }

    /**
     * Get GraphQl City View list
     * @param null $method
     * @return array
     */
    protected function getCityView($method = null, $cityRef = '', $settlementRef = '')
    {
        $data = [
            'input_view' => false,
            'input_type' => '',
            'input_data' => []
        ];
        if (NovaPoshtaWarehouse::CODE == $method) {
            $data = [
                'input_view' => true,
                //'input_type' => 'city',
                'input_data' => $this->cityRepository->getGraphQlList()
            ];
        }
        if (NovaPoshtaAddress::CODE == $method) {
            $data = [
                'input_view' => true,
                //'input_type' => 'settlement',
                'input_data' => $this->settlementRepository->getGraphQlList(['warehouse' => '1'])
            ];
        }
        if (KievFast::CODE == $method
            || KievSuburb::CODE == $method || KievStandard::CODE == $method) {
            $data = [
                'input_view' => true,
                //'input_type' => 'settlement',
                'input_data' => [
                    ['ref' => $settlementRef, 'name' => __('Kiev')]]
            ];
        }
        if (NovaPoshtaKiev::CODE == $method) {
            $data = [
                'input_view' => true,
                //'input_type' => 'city',
                'input_data' => [
                    ['ref' => $cityRef, 'name' => __('Kiev')]]
            ];
        }

        return $data;
    }

    protected function getWarehouseView($method, $cityRef)
    {
        $data = [
            'input_view' => false,
            'input_data' => []
        ];

        if (NovaPoshtaWarehouse::CODE == $method) {
            $data = [
                'input_view' => true,
                'input_data' => []
            ];
        }

        if (NovaPoshtaKiev::CODE == $method) {
            $data = [
                'input_view' => true,
                'input_data' => $this->warehouseRepository->getGraphQlList($cityRef)
            ];
        }

        return $data;
    }

    protected function getStreetView($method)
    {
        $data = [
            'input_view' => false,
            'input_data' => []
        ];

        if (NovaPoshtaAddress::CODE == $method || KievFast::CODE == $method
            || KievSuburb::CODE == $method || KievStandard::CODE == $method) {
            $data = [
                'input_view' => true,
                'input_data' => []
            ];
        }

        return $data;
    }
}
