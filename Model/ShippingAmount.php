<?php

namespace CodeCustom\NovaPoshta\Model;

use CodeCustom\NovaPoshta\Model\Curl\Transport;
use Magento\Quote\Model\Quote;
use CodeCustom\NovaPoshta\Helper\Sales\Quote as QuoteHelper;

class ShippingAmount
{

    const CITY_SENDER       = '8d5a980d-391c-11dd-90d9-001a92567626';
    const PACK_REF          = '1499fa4a-d26e-11e1-95e4-0026b97ed48a';

    /**
     * @var Transport
     */
    protected $transport;

    /**
     * @var QuoteHelper
     */
    protected $quoteHelper;

    /**
     * @param Transport $transport
     */
    public function __construct(
        Transport $transport,
        QuoteHelper $quoteHelper
    )
    {
        $this->transport = $transport;
        $this->quoteHelper = $quoteHelper;
    }

    /**
     * @param Quote $cart
     * @param string $cityRecipient
     * @return int|mixed
     * @throws \Exception
     */
    public function getOnlineShippingAmount(Quote $cart, string $cityRecipient)
    {
        $weight = $this->quoteHelper->getTotalCartWeight($cart);
        $totalPrice = $cart->getGrandTotal();
        $data = $this->transport->loadApiData(
            'InternetDocument',
            'getDocumentPrice',
            $this->getMethodProperies($cityRecipient, $weight, $totalPrice)
        );
        return isset($data[0]['Cost']) ? $data[0]['Cost'] : 0;
    }

    /**
     * @param $cityRecipient
     * @param $weight
     * @param $totalPrice
     * @return array
     */
    protected function getMethodProperies($cityRecipient, $weight, $totalPrice)
    {
        return [
            'CitySender' => self::CITY_SENDER,
            'CityRecipient' => $cityRecipient,
            'Weight' => $weight,
            'ServiceType' => 'DoorsDoors',
            'Cost' => (int) $totalPrice,
            'CargoType' => 'Cargo',
            'SeatsAmount' => '1',
            "PackCalculate" => [
                "PackCount" => "1",
                "PackRef" => self::PACK_REF
            ],
        ];
    }
}
