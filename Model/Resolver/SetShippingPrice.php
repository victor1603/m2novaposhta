<?php

namespace CodeCustom\NovaPoshta\Model\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\QuoteGraphQl\Model\Cart\GetCartForUser;
use CodeCustom\NovaPoshta\Model\ShippingAmount;
use CodeCustom\NovaPoshta\Helper\Config;

class SetShippingPrice implements ResolverInterface
{
    private $getCartForUser;

    private $shippingAmount;

    private $configHelper;

    public function __construct(
        GetCartForUser $getCartForUser,
        ShippingAmount $shippingAmount,
        Config $configHelper
    )
    {
        $this->getCartForUser = $getCartForUser;
        $this->shippingAmount = $shippingAmount;
        $this->configHelper = $configHelper;
    }

    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    )
    {
        if (empty($args['cartId'])) {
            throw new GraphQlInputException(__('Required parameter "cart_id" is missing'));
        }
        $maskedCartId = $args['cartId'];

        $currentUserId = $context->getUserId();
        $storeId = (int)$context->getExtensionAttributes()->getStore()->getId();
        $cart = $this->getCartForUser->execute($maskedCartId, $currentUserId, $storeId);

        $address = $cart->getShippingAddress();
        foreach ($address->getAllShippingRates() as $rate) {
            if (
                $rate->getCode() == $address->getShippingMethod()
                && $this->configHelper->getConfigData($rate->getCarrier(), Config::ONLINE_CALC_AMOUNT)
            ) {
                $price = $this->shippingAmount->getOnlineShippingAmount($cart, $args['cityRef']);
                $rate->setPrice($price);
                $rate->setCost($price);
                $cart->getShippingAddress()->setShippingAmount($price);
                $cart->getShippingAddress()->setBaseShippingAmount($price);
                break;
            }
        }
        return [
            'model' => $cart
        ];
    }
}
