<?php

namespace CodeCustom\NovaPoshta\Model\Repository;

use CodeCustom\NovaPoshta\Api\StreetRepositoryInterface;
use CodeCustom\NovaPoshta\Model\Curl\GoogleTransport;
use CodeCustom\NovaPoshta\Model\Curl\Transport;

class Street implements StreetRepositoryInterface
{

    protected $isGoogle = false;
    /**
     * @var GoogleTransport
     */
    protected $googleTransport;

    protected $transport;

    public function __construct(
        GoogleTransport $googleTransport,
        Transport $transport
    )
    {
        $this->googleTransport = $googleTransport;
        $this->transport = $transport;
    }

    public function getList()
    {
        // TODO: Implement getList() method.
    }

    /**
     * @param string $city
     * @param string $search
     * @return mixed|void
     */
    public function getGraqhQlList($city = '', $search = '')
    {
        if (!$city || !$search) {
            return [];
        }
        if ($this->isGoogle){
            return $this->googleTransport->loadData($city, $search);
        }

        $params = ['StreetName' => $search, 'SettlementRef' => $city, 'Limit' => 10];
        $data = $this->transport->loadApiData('Address', 'searchSettlementStreets', $params);
        return $this->novaPoshtaParseStreets($data);
    }

    /**
     * @param array $data
     * @return array|mixed
     */
    private function novaPoshtaParseStreets($data = [])
    {
        $result = null;
        $resultData = null;
        if (!empty($data) && is_array($data)) {
            foreach ($data as $key => $value) {
                if ($key !== "Addresses") {
                    $result = $this->novaPoshtaParseStreets($value);
                } else {
                    $resultData = $value;
                }
            }
        }

        if ($resultData) {
            foreach ($resultData as $item) {
                $streetType = isset($item['StreetsTypeDescription']) ? $item['StreetsTypeDescription'] : '';
                $streetName = isset($item['SettlementStreetDescriptionRu']) && $item['SettlementStreetDescriptionRu'] ?
                    $item['SettlementStreetDescriptionRu'] : (isset($item['SettlementStreetDescription']) ?
                        $item['SettlementStreetDescription'] : "");

                $result[] = [
                    'ref'   => isset($item['SettlementStreetRef']) ? $item['SettlementStreetRef'] : '',
                    'name'  =>  $streetType . $streetName];
            }
        }
        return $result;
    }

}
