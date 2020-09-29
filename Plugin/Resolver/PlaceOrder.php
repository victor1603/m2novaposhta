<?php

namespace CodeCustom\NovaPoshta\Plugin\Resolver;

use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\QuoteGraphQl\Model\Resolver\PlaceOrder as PlaseOrderResolve;
use Magento\Sales\Model\Order;

class PlaceOrder
{
    /**
     * @var PlaseOrderResolve
     */
    protected $placeOrderResolve;

    /**
     * @var Order
     */
    protected $orderModel;


    public function __construct(
        PlaseOrderResolve $placeOrderResolve,
        Order $orderModel
    )
    {
        $this->placeOrderResolve = $placeOrderResolve;
        $this->orderModel = $orderModel;
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
     * @throws \Exception
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
        if (!$resolvedValue['order']) {
            throw new GraphQlInputException(__("Order not created"));
        }

        try {
            $orderId = $resolvedValue['order']['order_number'];
            $order = $this->orderModel->loadByIncrementId($orderId);
            if ($order && $order->getId()) {
                $this->setShippingAddress($order, $args);
                $this->setBillingAddress($order, $args);
            }
        } catch (\Exception $e) {
            throw new \Exception(__($e->getMessage()));
        }

        return $resolvedValue;
    }

    /**
     * @var Order $order
     * @param null $order
     * @param array $args
     * @return bool
     * @throws \Exception
     */
    public function setShippingAddress($order = null, $args = [])
    {
        try {
            $order->getShippingAddress()->setCity($args['input']['shipping_additional']['city_title']);
            $order->getShippingAddress()->setStreet($args['input']['shipping_additional']['address_title']);
            $order->getShippingAddress()->setNovaposhtaCityRef($args['input']['shipping_additional']['city_ref']);
            $order->getShippingAddress()->setNovaposhtaWarehouseRef($args['input']['shipping_additional']['address_ref']);
            $order->getShippingAddress()->save();
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

        return true;
    }

    /**
     * @var Order $order
     * @param null $order
     * @param array $args
     * @return bool
     * @throws \Exception
     */
    public function setBillingAddress($order = null, $args = [])
    {
        try {
            $order->getBillingAddress()->setCity($args['input']['shipping_additional']['city_title']);
            $order->getBillingAddress()->setStreet($args['input']['shipping_additional']['address_title']);
            $order->getBillingAddress()->setNovaposhtaCityRef($args['input']['shipping_additional']['city_ref']);
            $order->getBillingAddress()->setNovaposhtaWarehouseRef($args['input']['shipping_additional']['address_ref']);
            $order->getBillingAddress()->save();
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

        return true;
    }
}
