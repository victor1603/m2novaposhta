<?php

namespace CodeCustom\NovaPoshta\Helper\Api;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;

class Config extends AbstractHelper
{

    const XML_CONFIG_API_URL        = 'novaposhta_credentials/credentials/api_url';
    const XML_CONFIG_API_KEY        = 'novaposhta_credentials/credentials/api_key';

    /**
     * @var StoreManagerInterface
     */
    protected $_storeManager;

    public function __construct(
        Context $context,
        StoreManagerInterface $_storeManager
    )
    {
        $this->_storeManager = $_storeManager;
        parent::__construct($context);
    }

    /** Getting system configuration by field path
     * @param $field
     * @param null $storeId
     * @return mixed
     */
    public function getConfigValue($field, $storeId = null)
    {
        $storeId = $storeId ? $storeId : $this->getSiteStoreId();
        return $this->scopeConfig->getValue(
            $field, ScopeInterface::SCOPE_STORE, $storeId
        );
    }

    /** Current store id
     * @return int|null
     */
    public function getSiteStoreId()
    {
        try {
            $storeId = $this->_storeManager->getStore()->getId();
            return $storeId;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Get api URL
     * @return mixed
     */
    public function getApiUrl()
    {
        return $this->getConfigValue(self::XML_CONFIG_API_URL);
    }

    /**
     * Get api KEY
     * @return mixed
     */
    public function getApiKey()
    {
        return $this->getConfigValue(self::XML_CONFIG_API_KEY);
    }

}
