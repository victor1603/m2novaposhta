<?php

namespace CodeCustom\NovaPoshta\Api;

interface StreetRepositoryInterface
{

    public function getList();

    /**
     * @param string $city
     * @param string $search
     * @return mixed
     */
    public function getGraqhQlList($city = '', $search = '');

}
