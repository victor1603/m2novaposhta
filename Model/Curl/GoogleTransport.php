<?php

namespace CodeCustom\NovaPoshta\Model\Curl;

use CodeCustom\NovaPoshta\Helper\Google\Config;
use Magento\Framework\HTTP\Client\Curl;

class GoogleTransport
{
    const ADDITIONAL_VARIABLES  = '&types=geocode&language=ru&types=address&country=&callback=initAutocomplete';
    const GOOGLEMAP_COUNTRY     = 'Украина';

    protected $configHelper;
    protected $curl;
    public function __construct(
        Config $configHelper,
        Curl $curl
    )
    {
        $this->configHelper = $configHelper;
        $this->curl = $curl;
    }

    public function loadData($city, $search = '')
    {
        $url = $this->configHelper->getGoogleMapsUrl() . "?key=".$this->configHelper->getGoogleKey() .
            self::ADDITIONAL_VARIABLES . "&input=" . self::GOOGLEMAP_COUNTRY . ", $city, $search";

        $urlToUse = str_replace(' ', '+', $url);
        $this->curl->get($urlToUse);
        $result = json_decode($this->curl->getBody(), true);
        return $this->parseData($result);
    }

    protected function parseData($data = null)
    {
        $result = [];

        if ($data && isset($data['status']) && $data['predictions'] && !empty($data['predictions'])) {
            foreach ($data['predictions'] as $item) {
                $result[] = ['name' => $this->getStreetName($item)];
            }
        }

        return $result;
    }

    protected function getStreetName($streetItem = null)
    {
        $street = '';
        if ($streetItem) {
            if (isset($streetItem['structured_formatting']) && isset($streetItem['structured_formatting']['main_text'])) {
                $street = $streetItem['structured_formatting']['main_text'];
            }
        }
        return $street;
    }
}
