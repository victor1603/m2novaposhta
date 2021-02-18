<?php

namespace CodeCustom\NovaPoshta\Model\Resolver;

use Magento\Customer\Model\Data\Customer;
use Magento\Customer\Model\Data\Address;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Customer\Api\AddressRepositoryInterface;
use Magento\Customer\Api\Data\AddressInterfaceFactory;
use Magento\Customer\Api\CustomerRepositoryInterface;

class CreateCustomerAddress implements ResolverInterface
{

    const DEFAULT_ADDRESS_COUNTRY_CODE = "UA";

    /**
     * @var CustomerRepositoryInterface
     */
    protected $customerRepository;

    /**
     * @var AddressInterfaceFactory
     */
    protected $addressInterfaceFactory;

    /**
     * @var AddressRepositoryInterface
     */
    protected $addressRepository;


    /**
     * CreateCustomerAddress constructor.
     * @param CustomerRepositoryInterface $customerRepository
     * @param AddressInterfaceFactory $addressInterfaceFactory
     * @param AddressRepositoryInterface $addressRepository
     */
    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        AddressInterfaceFactory $addressInterfaceFactory,
        AddressRepositoryInterface $addressRepository
    )
    {
        $this->customerRepository = $customerRepository;
        $this->addressInterfaceFactory = $addressInterfaceFactory;
        $this->addressRepository = $addressRepository;
    }

    /**
     * @param Field $field
     * @param \Magento\Framework\GraphQl\Query\Resolver\ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return array
     * @throws GraphQlAuthorizationException
     * @throws GraphQlNoSuchEntityException
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        if (false === $context->getExtensionAttributes()->getIsCustomer()) {
            throw new GraphQlAuthorizationException(__('The current customer isn\'t authorized.'));
        }

        try {
            $customer = $this->customerRepository->getById($context->getUserId());
            if (isset($args['input']['address_id']) && $args['input']['address_id']) {
                $address = $this->editAddress($customer, $args);
            } else {
                $address = $this->createAddress($customer, $args);
            }

            $result = [
                'address_id' => $address->getId(),
                'city' => $address->getCity(),
                'city_ref' => $address->getCustomAttribute('novaposhta_city_ref')->getValue(),
                'street' => isset($this->parseStreet($address)['street']) ? $this->parseStreet($address)['street'] : "",
                'house' => isset($this->parseStreet($address)['house']) ? $this->parseStreet($address)['house'] : "",
                'apartment' => isset($this->parseStreet($address)['apartment']) ? $this->parseStreet($address)['apartment'] : "",
                'warehouse' => $address->getCustomAttribute('novaposhta_warehouse_address')->getValue(),
                'warehouse_ref' => $address->getCustomAttribute('novaposhta_warehouse_ref')->getValue(),
            ];
        } catch (\Exception $exception) {
            throw new GraphQlNoSuchEntityException(__($exception->getMessage()));
        }

        return $result;
    }

    /**
     * create customer address
     *
     * @param $address Address
     * @param $customer \Magento\Customer\Model\Data\Customer
     */
    private function createAddress($customer, $args = [])
    {
        $telephone = $customer->getCustomAttribute('telephone')
            ? $customer->getCustomAttribute('telephone')->getValue()
            : "_";
        $address = $this->addressInterfaceFactory->create();
        $address->setFirstname($customer->getFirstname())
            ->setLastname($customer->getLastname())
            ->setCountryId(self::DEFAULT_ADDRESS_COUNTRY_CODE)
            ->setCity($args['input']['city'])
            ->setStreet([$this->getStreet($args)])
            ->setCustomerId($customer->getId())
            ->setTelephone($telephone)
            ->setCustomAttribute('novaposhta_city_ref', $args['input']['city_ref'])
            ->setCustomAttribute('novaposhta_warehouse_ref', $args['input']['warehouse_ref'])
            ->setCustomAttribute('novaposhta_warehouse_address', $args['input']['warehouse']);
        $this->addressRepository->save($address);

        return $address;
    }

    /**
     * Edit customer address by entity id
     *
     * @param $customer
     * @param $args
     * @return \Magento\Customer\Api\Data\AddressInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function editAddress($customer, $args)
    {
        $address = $this->addressRepository->getById($args['input']['address_id']);
        $address->setCity($args['input']['city'])
            ->setCustomAttribute('novaposhta_city_ref', $args['input']['city_ref'])
            ->setStreet([$this->getStreet($args)])
            ->setCustomAttribute('novaposhta_warehouse_ref', $args['input']['warehouse_ref'])
            ->setCustomAttribute('novaposhta_warehouse_address', $args['input']['warehouse']);
        $this->addressRepository->save($address);

        return $address;
    }

    /**
     * Helper method
     *
     * @param array $args
     * @return string
     */
    private function getStreet($args = [])
    {
        if (isset($args['input']['apartment']) && $args['input']['apartment']) {
            return $args['input']['street'] . ',' . $args['input']['house'] . ',' . $args['input']['apartment'];
        }

        return $args['input']['street'] . ',' . $args['input']['house'];
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
            return [];
        }
        $parse = explode(',', $address->getStreet()[0]);

        return [
            'street' => isset($parse[0]) ? $parse[0] : '',
            'house' => isset($parse[1]) ? $parse[1] : '',
            'apartment' => isset($parse[2]) ? $parse[2] : ''
        ];
    }
}
