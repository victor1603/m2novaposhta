<?php

namespace CodeCustom\NovaPoshta\Model\Resolver\ShippingAddress;

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

class SelectedShippingMethod implements ResolverInterface
{

    protected $cityRepository;

    public function __construct(
        CityRepositoryInterface $cityRepository
    )
    {
        $this->cityRepository = $cityRepository;
    }

    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        $method_code = isset($value['method_code']) ? $value['method_code'] : null;
        return [
            'city_view' => $this->getCityView($method_code),
            'warehouse_view' => $this->getWarehouseView($method_code),
            'street_view' => $this->getStreetView($method_code)
        ];
    }

    /**
     * Get GraphQl City View list
     * @param null $method
     * @return array
     */
    protected function getCityView($method = null)
    {
        $data = [
            'input_view' => false,
            'input_data' => []
        ];
        if (NovaPoshtaAddress::CODE == $method || NovaPoshtaWarehouse::CODE == $method) {
            $data = [
                'input_view' => true,
                'input_data' => $this->cityRepository->getGraphQlList()
            ];
        }
        if (NovaPoshtaKiev::CODE == $method || KievFast::CODE == $method
            || KievSuburb::CODE == $method || KievStandard::CODE == $method) {
            $data = [
                'input_view' => true,
                'input_data' => [
                    ['ref' => null, 'name' => __('Kiev')]]
            ];
        }

        return $data;
    }

    protected function getWarehouseView($method)
    {
        $data = [
            'input_view' => false,
            'input_data' => []
        ];

        if (NovaPoshtaKiev::CODE == $method || NovaPoshtaWarehouse::CODE == $method) {
            $data = [
                'input_view' => true,
                'input_data' => []
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
