<?php

namespace CodeCustom\NovaPoshta\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Store\Model\ScopeInterface;
use CodeCustom\NovaPoshta\Model\Carrier\KievFast;
use CodeCustom\NovaPoshta\Model\Carrier\KievStandard;
use CodeCustom\NovaPoshta\Model\Carrier\KievSuburb;
use CodeCustom\NovaPoshta\Model\Carrier\NovaPoshtaKiev;
use CodeCustom\NovaPoshta\Model\Carrier\NovaPoshtaAddress;
use CodeCustom\NovaPoshta\Model\Carrier\NovaPoshtaWarehouse;

class Config extends AbstractHelper
{
    const CODES = [
        KievSuburb::CODE,
        KievStandard::CODE,
        KievFast::CODE,
        NovaPoshtaWarehouse::CODE,
        NovaPoshtaAddress::CODE,
        NovaPoshtaKiev::CODE
    ];

    const ONLINE_CALC_AMOUNT = 'price_online_calc';

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * Config constructor.
     * @param Context $context
     * @param StoreManagerInterface $_storeManager
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $_storeManager
    )
    {
        $this->storeManager = $_storeManager;
        parent::__construct($context);
    }

    /**
     * @return int|null
     */
    public function getSiteStoreId()
    {
        try {
            $storeId = $this->storeManager->getStore()->getId();
            return $storeId;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * @param null $carrierCode
     * @param null $field
     * @param null $storeId
     * @return false|mixed
     */
    public function getConfigData($carrierCode = null, $field = null, $storeId = null)
    {
        if (empty($carrierCode)) {
            return false;
        }
        $path = 'carriers/' . $carrierCode . '/' . $field;
        $storeId = $storeId ? $storeId : $this->getSiteStoreId();
        return $this->scopeConfig->getValue(
            $path,
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }
}
