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


    /**
     * @var Order
     */
    protected $order;


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
            $this->order = $this->orderModel->loadByIncrementId($orderId);
            if ($this->order && $this->order->getId()) {
                $this->setShippingAddress($args);
                $this->setBillingAddress($args);
                $this->changeOrderCustomerData($args);
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
    public function setShippingAddress($args = [])
    {
        try {
            $this->order->getShippingAddress()->setCity($args['input']['shipping_additional']['city_title']);
            $this->order->getShippingAddress()->setStreet($args['input']['shipping_additional']['address_title']);
            $this->order->getShippingAddress()->setNovaposhtaCityRef($args['input']['shipping_additional']['city_ref']);
            $this->order->getShippingAddress()->setNovaposhtaWarehouseRef($args['input']['shipping_additional']['address_ref']);
            if (isset($args['input']['shipping_additional']['firstname_ad'])) {
                $this->order->getShippingAddress()->setFirstname($args['input']['shipping_additional']['firstname_ad']);
            }
            if (isset($args['input']['shipping_additional']['lastname_ad'])) {
                $this->order->getShippingAddress()->setLastname($args['input']['shipping_additional']['lastname_ad']);
            }
            if (isset($args['input']['shipping_additional']['email_ad'])) {
                $this->order->getShippingAddress()->setEmail($args['input']['shipping_additional']['email_ad']);
            }
            if (isset($args['input']['shipping_additional']['phone_ad'])) {
                $this->order->getShippingAddress()->setTelephone($args['input']['shipping_additional']['phone_ad']);
            }

            $this->order->getShippingAddress()->save();
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
    public function setBillingAddress($args = [])
    {
        try {
            $this->order->getBillingAddress()->setCity($args['input']['shipping_additional']['city_title']);
            $this->order->getBillingAddress()->setStreet($args['input']['shipping_additional']['address_title']);
            $this->order->getBillingAddress()->setNovaposhtaCityRef($args['input']['shipping_additional']['city_ref']);
            $this->order->getBillingAddress()->setNovaposhtaWarehouseRef($args['input']['shipping_additional']['address_ref']);

            if (isset($args['input']['shipping_additional']['firstname_ad'])) {
                $this->order->getBillingAddress()->setFirstname($args['input']['shipping_additional']['firstname_ad']);
            }
            if (isset($args['input']['shipping_additional']['lastname_ad'])) {
                $this->order->getBillingAddress()->setLastname($args['input']['shipping_additional']['lastname_ad']);
            }
            if (isset($args['input']['shipping_additional']['email_ad'])) {
                $this->order->getBillingAddress()->setEmail($args['input']['shipping_additional']['email_ad']);
            }
            if (isset($args['input']['shipping_additional']['phone_customer_ad']) &&
                $args['input']['shipping_additional']['phone_customer_ad']) {
                $this->order->getBillingAddress()->setTelephone($args['input']['shipping_additional']['phone_customer_ad']);
            } elseif (isset($args['input']['shipping_additional']['phone_ad'])) {
                $this->order->getBillingAddress()->setTelephone($args['input']['shipping_additional']['phone_ad']);
            }
            $this->order->getBillingAddress()->save();
        } catch (\Exception $exception) {
            throw new \Exception($exception->getMessage());
        }

        return true;
    }


    /**
     * @var Order $order
     * @param null $order
     * @param array $args
     */
    public function changeOrderCustomerData($args = [])
    {
        try {
            $this->order->addCommentToStatusHistory($args['input']['shipping_additional']['comment_ad']);
            $this->order->setCustomerEmail($args['input']['shipping_additional']['email_ad']);
            $this->order->setCustomerFirstname($args['input']['shipping_additional']['firstname_ad']);
            $this->order->setCustomerLastname($args['input']['shipping_additional']['lastname_ad']);
            $this->order->save();
        } catch (\Exception $exception) {
            return false;
        }

        return true;
    }
}
