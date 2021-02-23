<?php

namespace CodeCustom\NovaPoshta\Plugin\Resolver;

use CodeCustom\NovaPoshta\Model\Resolver\CreateCustomerAddress;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\QuoteGraphQl\Model\Resolver\PlaceOrder as PlaseOrderResolve;
use Magento\Sales\Model\Order;
use Magento\Customer\Api\Data\AddressInterfaceFactory;
use CodeCustom\NovaPoshta\Model\Carrier\NovaPoshtaWarehouse;
use CodeCustom\NovaPoshta\Model\Carrier\NovaPoshtaKiev;
use Magento\Customer\Api\AddressRepositoryInterface;
use Magento\Sales\Api\OrderManagementInterface;
use Magento\Sales\Model\OrderRepository;

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

    /**
     * @var AddressInterfaceFactory
     */
    protected $addressInterfaceFactory;

    /**
     * @var AddressRepositoryInterface
     */
    protected $addressRepository;

    /**
     * @var OrderManagementInterface
     */
    protected $orderManagment;

    protected $orderRepository;

    /**
     * PlaceOrder constructor.
     * @param PlaseOrderResolve $placeOrderResolve
     * @param Order $orderModel
     * @param AddressInterfaceFactory $addressInterfaceFactory
     * @param AddressRepositoryInterface $addressRepository
     */
    public function __construct(
        PlaseOrderResolve $placeOrderResolve,
        Order $orderModel,
        AddressInterfaceFactory $addressInterfaceFactory,
        AddressRepositoryInterface $addressRepository,
        OrderManagementInterface $orderManagement,
        OrderRepository $orderRepository
    )
    {
        $this->placeOrderResolve = $placeOrderResolve;
        $this->orderModel = $orderModel;
        $this->addressInterfaceFactory = $addressInterfaceFactory;
        $this->addressRepository = $addressRepository;
        $this->orderManagment = $orderManagement;
        $this->orderRepository = $orderRepository;
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
                if(isset($args['input']['shipping_additional']['customer_address_id'])
                    && $args['input']['shipping_additional']['customer_address_id'] == 'new')
                {
                    $this->createCustomerAddress($args);
                }
            }
        } catch (\Exception $e) {
            $this->orderManagment->cancel($this->order->getId());
            $this->orderRepository->deleteById($this->order->getId());
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
        $this->order->getShippingAddress()->setCity($args['input']['shipping_additional']['city_title']);
        $this->order->getShippingAddress()->setStreet($this->getStreet($args));
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
        $this->order->getBillingAddress()->setCity($args['input']['shipping_additional']['city_title']);
        $this->order->getBillingAddress()->setStreet($this->getStreet($args));
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

        return true;
    }


    /**
     * @var Order $order
     * @param null $order
     * @param array $args
     */
    public function changeOrderCustomerData($args = [])
    {
        $this->order->addCommentToStatusHistory($args['input']['shipping_additional']['comment_ad']);
        $this->order->setCustomerEmail($args['input']['shipping_additional']['email_ad']);
        $this->order->setCustomerFirstname($args['input']['shipping_additional']['firstname_ad']);
        $this->order->setCustomerLastname($args['input']['shipping_additional']['lastname_ad']);
        $this->order->save();

        return true;
    }

    /**
     * @param $order Order
     * @param array $args
     * @return false
     */
    public function createCustomerAddress($args = [])
    {
        if (!isset($args['input']['shipping_additional']['customer_address_id'])) {
            return false;
        }

        $address = $this->addressInterfaceFactory->create();
        $address->setFirstname($this->order->getCustomerFirstname())
            ->setLastname($this->order->getCustomerLastname())
            ->setCountryId(CreateCustomerAddress::DEFAULT_ADDRESS_COUNTRY_CODE)
            ->setCity($args['input']['shipping_additional']['city_title'])
            ->setCustomAttribute('novaposhta_city_ref', $args['input']['shipping_additional']['city_ref'])
            ->setTelephone($this->order->getShippingAddress()->getTelephone())
            ->setCustomerId($this->order->getCustomerId());
        if ($this->order->getShippingMethod() == NovaPoshtaWarehouse::CODE
            || $this->order->getShippingMethod() == NovaPoshtaKiev::CODE)
        {
            $address->setStreet(["-,-,-"])
            ->setCustomAttribute('novaposhta_warehouse_ref', $args['input']['shipping_additional']['address_ref'])
            ->setCustomAttribute('novaposhta_warehouse_address', $args['input']['shipping_additional']['address_title']);
        } else {
            $address->setStreet([$this->getStreet($args)])
                ->setCustomAttribute('novaposhta_warehouse_ref', "-")
                ->setCustomAttribute('novaposhta_warehouse_address', "-");
        }
        $this->addressRepository->save($address);
    }

    /**
     * Helper method
     *
     * @param array $args
     * @return string
     */
    private function getStreet($args = [])
    {
        if (isset($args['input']['shipping_additional']['apartment'])
            && $args['input']['shipping_additional']['apartment']) {
            return $args['input']['shipping_additional']['address_title']
                . ',' . $args['input']['shipping_additional']['house']
                . ',' . $args['input']['shipping_additional']['apartment'];
        }

        return $args['input']['shipping_additional']['address_title']
            . ',' . $args['input']['shipping_additional']['house'];
    }

}
