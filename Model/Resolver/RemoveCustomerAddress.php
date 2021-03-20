<?php

namespace CodeCustom\NovaPoshta\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlAuthorizationException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Customer\Api\AddressRepositoryInterface;

class RemoveCustomerAddress implements ResolverInterface
{

    /**
     * @var AddressRepositoryInterface
     */
    protected $addressRepository;

    /**
     * RemoveCustomerAddress constructor.
     * @param AddressRepositoryInterface $addressRepository
     */
    public function __construct(
        AddressRepositoryInterface $addressRepository
    )
    {
        $this->addressRepository = $addressRepository;
    }

    /**
     * @param Field $field
     * @param \Magento\Framework\GraphQl\Query\Resolver\ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return bool
     * @throws GraphQlAuthorizationException
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        if (false === $context->getExtensionAttributes()->getIsCustomer()) {
            throw new GraphQlAuthorizationException(__('The current customer isn\'t authorized.'));
        }

        $result = false;
        try {
            $addressId = isset($args['address_id']) && $args['address_id'] ? $args['address_id'] : null;
            if ($addressId) {
                $this->addressRepository->deleteById($addressId);
                $result = true;
            }

        } catch (\Exception $exception) {
            $result = false;
        }

        return $result;
    }
}
