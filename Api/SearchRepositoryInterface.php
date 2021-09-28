<?php

namespace CodeCustom\NovaPoshta\Api;

use CodeCustom\NovaPoshta\Api\Data\SearchInterface;

interface SearchRepositoryInterface
{
    /**
     * @param $entity_id
     * @return SearchInterface|null
     */
    public function getItemByEntityId($entity_id);

    /**
     * @param $search_key
     * @return SearchInterface|null
     */
    public function getItemBySearchKey($search_key);

    /**
     * @param SearchInterface $search
     * @return mixed
     */
    public function save(SearchInterface $search);

    /**
     * @param SearchInterface $search
     * @return mixed
     */
    public function deleteBySearchKey(SearchInterface $search);
}
