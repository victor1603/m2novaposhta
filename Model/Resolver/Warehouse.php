<?php

namespace CodeCustom\NovaPoshta\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use CodeCustom\NovaPoshta\Api\WarehouseRepositoryInterface;
use Magento\Quote\Model\Cart\CustomerCartResolver;
use CodeCustom\NovaPoshta\Helper\Sales\Quote as QuoteHelper;

class Warehouse implements ResolverInterface
{

    /**
     * @var WarehouseRepositoryInterface
     */
    protected $warehouseRepository;

    /**
     * @var CustomerCartResolver
     */
    protected $customerCartResolver;

    /**
     * @var QuoteHelper
     */
    protected $quoteHelper;

    public function __construct(
        WarehouseRepositoryInterface $warehouseRepository,
        CustomerCartResolver $cartResolver,
        QuoteHelper $quoteHelper
    )
    {
        $this->warehouseRepository = $warehouseRepository;
        $this->customerCartResolver = $cartResolver;
        $this->quoteHelper = $quoteHelper;
    }

    /**
     * @param Field $field
     * @param \Magento\Framework\GraphQl\Query\Resolver\ContextInterface $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return \Magento\Framework\GraphQl\Query\Resolver\Value|mixed
     */
    public function resolve(Field $field, $context, ResolveInfo $info, array $value = null, array $args = null)
    {
        try {
            $customerId = $context->getUserId();
            $cart = $this->customerCartResolver->resolve($customerId);
            $totalCartWeight = $this->quoteHelper->getTotalCartWeight($cart);
        } catch (\Exception $exception) {
            throw new GraphQlNoSuchEntityException(
                __('Could not find a customer ')
            );
        }
        return $this->warehouseRepository->getGraphQlListBySettlementRef(
            $args['settlement_ref'],
            $args['search'],
            $totalCartWeight
        );
    }
}
