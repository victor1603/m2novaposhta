<?php

namespace CodeCustom\NovaPoshta\Helper\Sales;

class Quote
{

    public function __construct(){}

    /**
     * @param \Magento\Quote\Model\Quote $quote
     */
    public function getTotalCartWeight($quote)
    {
        if ($quote && !$quote->getEntityId()) {
            return 0;
        }

        $weight = 0;
        foreach ($quote->getAllItems() as $item) {
            $weight += ($item->getWeight() * $item->getQty()) ;
        }
        return $weight;
    }
}
