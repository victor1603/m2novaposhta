<?php

namespace CodeCustom\NovaPoshta\Plugin;

use Magento\Checkout\Model\ShippingInformationManagement;
use Magento\Checkout\Api\Data\ShippingInformationInterface;
use Magento\Quote\Api\CartRepositoryInterface;
use CodeCustom\NovaPoshta\Model\Carrier\NovaPoshtaWarehouse;

class ShippingInformationManagementPlugin
{
    protected $cartRepository;

    protected $extensionAttributes = null;

    public function __construct(
        CartRepositoryInterface $cartRepository
    )
    {
        $this->cartRepository = $cartRepository;
    }

    public function beforeSaveAddressInformation(
        ShippingInformationManagement $subject,
        $cartId,
        ShippingInformationInterface $addressInformation
    ) {
        $shippingAddress = $addressInformation->getShippingAddress();
        $this->extensionAttributes = $shippingAddress->getExtensionAttributes();
        //$shippingAddress->setNovaposhtaCityRef($extensionAttributes->getNovaposhtaCityRef());
        //$shippingAddress->setNovaposhtaWarehouseRef($extensionAttributes->getNovaposhtaWarehouseRef());
    }

    public function afterSaveAddressInformation(
        ShippingInformationManagement $subject,
        $result,
        $cartId,
        $addressInformation
    )
    {
        /** @var \Magento\Quote\Model\Quote $quote */
        $quote = $this->cartRepository->getActive($cartId);
        $shippingAddress = $quote->getShippingAddress();

        if ($addressInformation->getShippingMethodCode() == NovaPoshtaWarehouse::CODE) {
            $shippingAddress->save();
        }
        return $result;
    }
}
