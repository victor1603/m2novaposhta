<?php

namespace CodeCustom\NovaPoshta\Model\Resolver\ShippingAddress;

use CodeCustom\NovaPoshta\Api\SettlementRepositoryInterface;
use Magento\Customer\Model\Address;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException;
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
use Magento\Customer\Model\ResourceModel\Address\CollectionFactory as AddressCollectionFactory;


class SelectedShippingMethod implements ResolverInterface
{

    const ONE_CITY_ATTR = 'novaposhta_city_ref';

    /**
     * @var CityRepositoryInterface
     */
    protected $cityRepository;

    /**
     * @var SettlementRepositoryInterface
     */
    protected $settlementRepository;

    /**
     * @var WarehouseRepositoryInterface
     */
    protected $warehouseRepository;

    /**
     * @var AddressCollectionFactory
     */
    protected $addressCollectionFactory;

    /**
     * @var string
     */
    protected $oneCityTitle = "kiev";

    /**
     * @var string
     */
    protected $oneCityRef = "e718a680-4b33-11e4-ab6d-005056801329";

    /**
     * SelectedShippingMethod constructor.
     * @param CityRepositoryInterface $cityRepository
     * @param SettlementRepositoryInterface $settlementRepository
     * @param WarehouseRepositoryInterface $warehouseRepository
     * @param AddressCollectionFactory $addressCollectionFactory
     */
    public function __construct(
        CityRepositoryInterface $cityRepository,
        SettlementRepositoryInterface $settlementRepository,
        WarehouseRepositoryInterface $warehouseRepository,
        AddressCollectionFactory $addressCollectionFactory
    )
    {
        $this->cityRepository = $cityRepository;
        $this->settlementRepository = $settlementRepository;
        $this->warehouseRepository = $warehouseRepository;
        $this->addressCollectionFactory = $addressCollectionFactory;
    }

    /**
     * @param Field $field
     * @param \Magento\Framework\GraphQl\Query\Resolver\ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        if (false === $context->getExtensionAttributes()->getIsCustomer()) {
            throw new GraphQlAuthorizationException(__('The current customer isn\'t authorized.'));
        }

        $method_code = isset($value['method_code']) ? $value['method_code'] : null;
        $kievCityRef = $this->cityRepository->getElementKey($this->oneCityTitle);
        $kievSettlementRef = $this->settlementRepository->getElementKey($this->oneCityTitle);
        return [
            'city_view' => $this->getCityView($method_code, $kievCityRef, $kievSettlementRef),
            'warehouse_view' => $this->getWarehouseView($method_code, $kievCityRef),
            'street_view' => $this->getStreetView($method_code),
            'customer_address' => $this->getCustomerAddresses($method_code, $context->getUserId())
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
                'input_data' => $this->settlementRepository->getGraphQlList(['warehouse' => '1'])
            ];
        }
        if (NovaPoshtaAddress::CODE == $method) {
            $data = [
                'input_view' => true,
                //'input_type' => 'settlement',
                'input_data' => $this->settlementRepository->getGraphQlList()
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

    /**
     * @param $method
     * @param $cityRef
     * @return array
     */
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

    /**
     * @param $method
     * @return array
     */
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

    /**
     * @param $method
     * @return array
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function getCustomerAddresses($method, $customerId = null)
    {
        $operation = NovaPoshtaKiev::CODE == $method || KievFast::CODE == $method || KievStandard::CODE == $method
            ? 'eq' : 'neq';
        $collection = $this->addressCollectionFactory->create();
        $collection->addAttributeToSelect('*')
            ->addFieldToFilter('parent_id', ['eq' => $customerId])
            ->addAttributeToFilter(self::ONE_CITY_ATTR, [$operation => $this->oneCityRef]);

        if ($method == NovaPoshtaWarehouse::CODE || $method == NovaPoshtaKiev::CODE) {
            $collection
                ->addAttributeToFilter([
                    ['attribute' => 'novaposhta_warehouse_address', 'neq' => '-']
                ])
                ->addAttributeToFilter([
                    ['attribute' => 'novaposhta_warehouse_address', 'neq' => '']
                ]);
        } else {
            $collection
                ->addFieldToFilter([
                    ['attribute' => 'street', 'neq' => '-']
                ])
                ->addFieldTofilter([
                    ['attribute' => 'street', 'neq' => '']
                ]);
        }

        $data = [];
        if ($collection->getSize()) {
            foreach ($collection as $item) {
                $data[] = $this->getData($item, $method);
            }
        }
        return $data;
    }

    /**
     * get array with address data
     *
     * @param $address Address
     */
    public function getData($address, $method)
    {

        $selectTitle = $method == NovaPoshtaWarehouse::CODE || $method == NovaPoshtaKiev::CODE
            ? $address->getCity() . ', ' . $address->getData('novaposhta_warehouse_address')
            : $address->getCity() . ', ' . $this->parseStreet($address)['street'] . ', '
            . $this->parseStreet($address)['house'] . ', ' . $this->parseStreet($address)['apartment'];

        return [
            'address_id' => $address->getId(),
            'city' => $address->getCity(),
            'city_ref' => $address->getData('novaposhta_city_ref'),
            'street' => isset($this->parseStreet($address)['street']) ? $this->parseStreet($address)['street'] : "",
            'house' => isset($this->parseStreet($address)['house']) ? $this->parseStreet($address)['house'] : "",
            'apartment' => isset($this->parseStreet($address)['apartment']) ? $this->parseStreet($address)['apartment'] : "",
            'warehouse' => $address->getData('novaposhta_warehouse_address'),
            'warehouse_ref' => $address->getData('novaposhta_warehouse_ref'),
            'select_title' => $selectTitle
        ];
    }

    /**
     * Helper method
     *
     * @param $address
     * @return array
     */
    private function parseStreet($address)
    {
        if(!isset($address->getStreet()[0])) {
            return [
                'street' => '',
                'house' => '',
                'apartment' => ''
            ];
        }
        $parse = explode(',', $address->getStreet()[0]);

        return [
            'street' => isset($parse[0]) ? $parse[0] : '',
            'house' => isset($parse[1]) ? $parse[1] : '',
            'apartment' => isset($parse[2]) ? $parse[2] : ''
        ];
    }
}
