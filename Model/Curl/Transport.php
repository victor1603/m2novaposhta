<?php

namespace CodeCustom\NovaPoshta\Model\Curl;

use CodeCustom\NovaPoshta\Helper\Api\Config;
use CodeCustom\NovaPoshta\Model\Repository\Settlement as SettlementRepository;
use Magento\Framework\HTTP\Client\Curl;

class Transport
{
    const HEADER                    = 'content-type: application/json';
    const PAGINATION_PAGE_SIZE      = 150;
    const ADDRESS_GENERAL           = 'AddressGeneral';
    const METHOD_SETTLEMENT         = 'getSettlements';

    /**
     * @var Config
     */
    protected $configHelper;

    /**
     * @var Curl
     */
    protected $curl;

    private $retryConnect = 0;


    public function __construct(
        Config $configHelper,
        Curl $curl
    )
    {
        $this->configHelper = $configHelper;
        $this->curl = $curl;
    }

    /**
     * @param null $calledMethod
     * @param array $methodProperties
     * @return mixed|null
     * @throws \Exception
     */
    public function loadApiData($modelName = 'Address', $calledMethod = null, array $methodProperties = [], $page = 1)
    {
        $result = null;
        if ($calledMethod) {
            try {
                $params['apiKey'] = $this->configHelper->getApiKey();
                $params['modelName'] = $modelName;
                $params['calledMethod'] = $calledMethod;

                if (!empty($methodProperties)) {
                    foreach ($methodProperties as $key => $value) {
                        if ($key) {
                            $params['methodProperties'][$key] = $value;
                        }
                    }
                }

                $this->curl->setHeaders([self::HEADER]);
                if ($calledMethod == SettlementRepository::NP_CALLED_METHOD) {
                    $this->curl->setOption(CURLOPT_TIMEOUT, 8);
                }
                $this->curl->post($this->configHelper->getApiUrl(), json_encode($params));
                $result = json_decode($this->curl->getBody(), true);
                $resultData = isset($result['data']) ? $result['data'] : $result;
                $this->retryConnect = 0;
            } catch (\Exception $exception) {
                if ($this->retryConnect < 100) {
                    $this->retryConnect++;
                    $resultData = $this->loadApiData($modelName, $calledMethod, $methodProperties, $page);
                } else {
                    throw new \Exception($exception->getMessage(), $exception->getCode());
                }

            }
        }

        /**
         * If we have pagination like NO method getSettlents
         */

        if ($this->issetNextPage($result, $page)) {
            $nextPage = $page + 1;
            $resultData = array_merge($resultData, $this->loadApiData(
                $modelName,
                $calledMethod,
                $methodProperties + ['Page' => $nextPage],
                $nextPage
            ));
        }

        return $resultData;
    }

    /**
     * @param array $data
     * @param int $currentPage
     * @return bool
     */
    protected function issetNextPage($data = [], $currentPage = 1)
    {
        $data['info'] = isset($data['info']['totalCount']) ? $data['info'] : $data['info'][0];
        if (isset($data['info']['totalCount']) && isset($data['data']) && $data['info']['totalCount'] > count($data['data'])) {
            if ($data['info']['totalCount'] > $currentPage * self::PAGINATION_PAGE_SIZE) {
                return true;
            }
        }
        false;
    }

}
