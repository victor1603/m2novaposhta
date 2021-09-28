<?php

namespace CodeCustom\NovaPoshta\Model;

use CodeCustom\NovaPoshta\Api\Data\SearchInterface;
use CodeCustom\NovaPoshta\Api\SearchRepositoryInterface;
use CodeCustom\NovaPoshta\Model\ResourceModel\Search as SearchResource;
use CodeCustom\NovaPoshta\Model\SearchFactory;

class SearchRepository implements SearchRepositoryInterface
{
    /**
     * @var \CodeCustom\NovaPoshta\Model\SearchFactory
     */
    protected $searchFactory;

    /**
     * @var SearchResource
     */
    protected $searchResource;

    public function __construct(
        SearchResource $searchResource,
        SearchFactory $searchFactory
    )
    {
        $this->searchResource = $searchResource;
        $this->searchFactory = $searchFactory;
    }

    /**
     * @param $entity_id
     * @return SearchInterface
     */
    public function getItemByEntityId($entity_id)
    {
        $object = $this->searchFactory->create();
        $this->searchResource->load($object, $entity_id);
        return $object;
    }

    /**
     * @param SearchInterface $search
     * @return mixed
     */
    public function save(SearchInterface $search)
    {
        try {
            $this->searchResource->save($search);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__('Could not save Source'), $exception);
        }
        return $search;
    }

    /**
     * @param SearchInterface $search
     * @return mixed
     */
    public function deleteBySearchKey(SearchInterface $search)
    {
        try {
            $this->searchResource->delete($search);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__('Could not delete Source'), $exception);
        }
        return true;
    }

    /**
     * @param $search_key
     * @return SearchInterface
     */
    public function getItemBySearchKey($search_key)
    {
        $object = $this->searchFactory->create();
        $this->searchResource->load($object, $search_key, 'search_key');
        return $object;
    }
}
