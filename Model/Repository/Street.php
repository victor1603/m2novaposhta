<?php

namespace CodeCustom\NovaPoshta\Model\Repository;

use CodeCustom\NovaPoshta\Api\StreetRepositoryInterface;
use CodeCustom\NovaPoshta\Model\Curl\GoogleTransport;

class Street implements StreetRepositoryInterface
{

    /**
     * @var GoogleTransport
     */
    protected $transport;

    public function __construct(
        GoogleTransport $transport
    )
    {
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
        return $this->transport->loadData($city, $search);
    }

}
