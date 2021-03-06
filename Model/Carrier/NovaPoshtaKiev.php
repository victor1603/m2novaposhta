<?php

namespace CodeCustom\NovaPoshta\Model\Carrier;

use Magento\Quote\Model\Quote\Address\RateRequest;
use Magento\Shipping\Model\Carrier\AbstractCarrier;
use Magento\Shipping\Model\Carrier\CarrierInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Quote\Model\Quote\Address\RateResult\ErrorFactory;
use Psr\Log\LoggerInterface;
use Magento\Shipping\Model\Rate\ResultFactory;
use Magento\Quote\Model\Quote\Address\RateResult\MethodFactory;

class NovaPoshtaKiev extends AbstractCarrier implements CarrierInterface
{
    const CODE = 'novaposhtashippingkiev';
    protected $_code = 'novaposhtashippingkiev';

    protected $_isFixed = false;

    protected $rateResultFactory;

    protected $rateMethodFactory;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        ErrorFactory $rateErrorFactory,
        LoggerInterface $logger,
        ResultFactory $rateResultFactory,
        MethodFactory $rateMethodFactory,
        array $data = []
    )
    {
        $this->rateMethodFactory = $rateMethodFactory;
        $this->rateResultFactory = $rateResultFactory;
        parent::__construct($scopeConfig, $rateErrorFactory, $logger, $data);
    }

    public function collectRates(RateRequest $request)
    {
        if (!$this->isActive()) {
            return false;
        }

        $result = $this->rateResultFactory->create();
        $shippingPrice = $this->getConfigData('price');

        /** @var \Magento\Quote\Model\Quote\Address\RateResult\Method $method */
        $method = $this->rateMethodFactory->create();
        $method->setCarrier($this->getCarrierCode());
        $method->setCarrierTitle($this->getConfigData('title'));
        $method->setMethod($this->getCarrierCode());
        $method->setMethodTitle($this->getConfigData('title'));
        $method->setPrice($shippingPrice);
        $method->setCost($shippingPrice);
        $result->append($method);

        return $result;
    }

    public function getAllowedMethods()
    {
        return [$this->getCarrierCode() => __($this->getConfigData('title'))];
    }
}
