<?php

namespace CodeCustom\NovaPoshta\Model\Resolver;

use Magento\Customer\Model\Address;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Customer\Model\ResourceModel\Address\CollectionFactory;

class CustomerAddress implements ResolverInterface
{

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * CustomerAddress constructor.
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        CollectionFactory $collectionFactory
    )
    {
        $this->collectionFactory = $collectionFactory;
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

        $currentPage = isset($args['page']) && is_numeric($args['page']) ? $args['page'] : 1;
        $collection = $this->collectionFactory->create();
        $collection->setCustomerFilter([$context->getUserId()])
            ->addAttributeToSelect('*')
            ->setCurPage($currentPage)
            ->setPageSize(2);
        $data = [];
        try {
            if ($collection && $collection->getSize()) {
                /**
                 * @var $item Address
                 */
                foreach ($collection as $item) {
                    $data[] = $this->getData($item);
                }

                $result = [
                    'total_count' => $collection->getSize(),
                    'addresses' => $data,
                    'page_info' => [
                        'page_size' => $collection->getPageSize(),
                        'current_page' => $collection->getCurPage(),
                        'total_pages' => $collection->getLastPageNumber(),
                    ]
                ];
            }
        } catch (\Exception $exception) {
            throw new GraphQlNoSuchEntityException(__($exception->getMessage()));
        }


        return $result;
    }

    /**
     * get array with address data
     *
     * @param $address Address
     */
    public function getData($address)
    {
        return [
            'address_id' => $address->getId(),
            'city' => $address->getCity(),
            'city_ref' => $address->getData('novaposhta_city_ref'),
            'street' => isset($this->parseStreet($address)['street']) ? $this->parseStreet($address)['street'] : "",
            'house' => isset($this->parseStreet($address)['house']) ? $this->parseStreet($address)['house'] : "",
            'apartment' => isset($this->parseStreet($address)['apartment']) ? $this->parseStreet($address)['apartment'] : "",
            'warehouse' => $address->getData('novaposhta_warehouse_address'),
            'warehouse_ref' => $address->getData('novaposhta_warehouse_ref')
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
