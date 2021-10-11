<?php

namespace CodeCustom\NovaPoshta\Plugin\Quote;

use Magento\Quote\Model\Quote;
use Magento\Quote\Model\Quote\Address\Total;
use Magento\Quote\Model\Quote\TotalsCollector;

class AddressPlugin
{

    public function __construct()
    {}

    /**
     * @param Quote\Address\Total $subject
     * @param Quote $quote
     * @param callable $proceed
     * @return mixed
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function afterCollect(
        TotalsCollector $subject,
        Total $total,
        Quote $quote
    )
    {
        /**
         * Here we can add new logic for custom discounts using on PWA-theme
         * this method call once
         */
        return $total;
    }
}
