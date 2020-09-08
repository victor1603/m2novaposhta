<?php

namespace CodeCustom\NovaPoshta\Plugin\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\QuoteGraphQl\Model\Resolver\ShippingAddress\AvailableShippingMethods as AvailableShippingMethodsResolve;
use CodeCustom\NovaPoshta\Helper\Config as CarrierConfig;

class AvailableShippingMethods
{
    /**
     * @var CarrierConfig
     */
    protected $configHelper;

    public function __construct(
        CarrierConfig $config
    )
    {
        $this->configHelper = $config;
    }

    /**
     * @param ResolverInterface $subject
     * @param $resolvedValue
     * @param Field $field
     * @param $context
     * @param ResolveInfo $info
     * @param array|null $value
     * @param array|null $args
     * @return mixed
     */
    public function afterResolve(
        ResolverInterface $subject,
        $resolvedValue,
        Field $field,
        $context,
        ResolveInfo $info,
        array $value = null,
        array $args = null
    )
    {
        if (!empty($resolvedValue)) {
            $address = clone $value['model'];
            $cart = $address->getQuote();
            foreach ($resolvedValue as $key => $item) {
                if (in_array($item['method_code'], CarrierConfig::CODES)) {
                    $resolvedValue[$key]['enable_field'] = $this->isDisableShipping($item['method_code'], $cart);
                    $resolvedValue[$key]['shipping_desc'] = $this->configHelper->getConfigData($item['method_code'], 'desc');
                } else {
                    $resolvedValue[$key]['enable_field'] = true;
                    $resolvedValue[$key]['shipping_desc'] = null;
                }
            }
        }
        return $resolvedValue;
    }

    /**
     * @param $code
     * @param $cart
     * @return bool
     */
    public function isDisableShipping($code, $cart)
    {
        $minPrice = $this->configHelper->getConfigData($code, 'min_price');
        if ($minPrice && $minPrice > $cart->getGrandTotal()) {
            return false;
        }
        return true;
    }
}
