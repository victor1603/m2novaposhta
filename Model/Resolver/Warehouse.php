<?php

namespace CodeCustom\NovaPoshta\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlNoSuchEntityException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use CodeCustom\NovaPoshta\Api\WarehouseRepositoryInterface;
use CodeCustom\NovaPoshta\Helper\Sales\Quote as QuoteHelper;
use Magento\Quote\Model\MaskedQuoteIdToQuoteIdInterface;
use Magento\Quote\Model\QuoteFactory;

class Warehouse implements ResolverInterface
{

    /**
     * @var WarehouseRepositoryInterface
     */
    protected $warehouseRepository;

    /**
     * @var QuoteFactory
     */
    protected $quoteFactory;

    /**
     * @var MaskedQuoteIdToQuoteIdInterface
     */
    protected $maskedQuoteIdToQuoteId;
    /**
     * @var QuoteHelper
     */
    protected $quoteHelper;

    public function __construct(
        WarehouseRepositoryInterface $warehouseRepository,
        QuoteFactory $quoteFactory,
        MaskedQuoteIdToQuoteIdInterface $maskedQuoteIdToQuoteId,
        QuoteHelper $quoteHelper
    )
    {
        $this->warehouseRepository = $warehouseRepository;
        $this->quoteFactory = $quoteFactory;
        $this->quoteHelper = $quoteHelper;
        $this->maskedQuoteIdToQuoteId = $maskedQuoteIdToQuoteId;
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
            $values = $info->variableValues;
            $cartHash = $values['cartId'];
            $cartId = $this->maskedQuoteIdToQuoteId->execute($cartHash);
            $cart = $this->quoteFactory->create()->loadActive($cartId);
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
