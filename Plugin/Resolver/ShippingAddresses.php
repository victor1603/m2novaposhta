<?php

namespace CodeCustom\NovaPoshta\Plugin\Resolver;

use CodeCustom\NovaPoshta\Helper\Config as CarrierConfig;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Quote\Model\Quote\AddressFactory;
use Magento\QuoteGraphQl\Model\Cart\ExtractQuoteAddressData;


class ShippingAddresses
{
    protected $addressFactory;

    private $extractQuoteAddressData;

    public function __construct(
        AddressFactory $addressFactory,
        ExtractQuoteAddressData $extractQuoteAddressData
    )
    {
        $this->addressFactory = $addressFactory;
        $this->extractQuoteAddressData = $extractQuoteAddressData;
    }

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
        if (empty($resolvedValue)) {
            $cart = $value['model'];
            $shippingAddresses = $cart->getAllShippingAddresses();
            if (empty($shippingAddresses)) {
                $shippingAddress = $this->addressFactory->create();
                $address = $this->createEmptyShipping($shippingAddress, $cart);
                $address->setQuote($cart);
                $address->save();
                $resolvedValue[] = ['model' => $address];
            } else {
                foreach ($shippingAddresses as $shippingAddress) {
                    $address = $this->createEmptyShipping($shippingAddress, $cart);
                    $addressesData[] = $address;
                }
                $resolvedValue = $addressesData;
            }
        }
        return $resolvedValue;
    }

    public function createEmptyShipping($shippingAddress, $cart)
    {
        try {
            $customEmail = time() . '@xxx.com';
            if (!$cart->getCustomerId()) {
                $cart->setCustomerEmail($customEmail);
            }
            $firstName = $cart->getCustomerFirstname() ? $cart->getCustomerFirstname() : '_';
            $lastName = $cart->getCustomerLastname() ? $cart->getCustomerLastname() : '_';
            $shippingAddress->setCountryId('UA');
            $shippingAddress->setCity('_');
            $shippingAddress->setState(0);
            $shippingAddress->setPostcode('_');
            $shippingAddress->setStreet('_');
            $shippingAddress->setFirstname($firstName);
            $shippingAddress->setLastname($lastName);
            $shippingAddress->setEmail($customEmail);
            $shippingAddress->setTelephone('_');
            $address = $this->extractQuoteAddressData->execute($shippingAddress);
            $cart->save();
        } catch (\Exception $exception) {
            throw new \Exception(__('Wrong shipping data'));
        }
        return $address;
    }
}
