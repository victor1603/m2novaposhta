<?php

namespace CodeCustom\NovaPoshta\Api\Data;

interface SearchInterface
{
    /**
     * @param $entity_id
     * @return mixed
     */
    public function setEntityId($entity_id);

    /**
     * @return mixed
     */
    public function getEntityId();

    /**
     * @param $search_key
     * @return mixed
     */
    public function setSearchKey($search_key);

    /**
     * @return mixed
     */
    public function getSearchKey();

    /**
     * @param $search_value
     * @return mixed
     */
    public function setSearchValue($search_value);

    /**
     * @return mixed
     */
    public function getSearchValue();
}
