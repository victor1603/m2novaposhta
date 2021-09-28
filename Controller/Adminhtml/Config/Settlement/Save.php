<?php

namespace CodeCustom\NovaPoshta\Controller\Adminhtml\Config\Settlement;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use CodeCustom\NovaPoshta\Model\Repository\Settlement;
use CodeCustom\NovaPoshta\Api\SearchRepositoryInterface;
use CodeCustom\NovaPoshta\Model\Search;

class Save extends Action
{
    protected $settlementRepository;

    protected $searchRepository;

    protected $jsonFactory;

    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        Settlement $settlementRepository,
        SearchRepositoryInterface $searchRepository
    )
    {
        $this->jsonFactory = $jsonFactory;
        $this->settlementRepository = $settlementRepository;
        $this->searchRepository = $searchRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $result = $this->jsonFactory->create();
        try {
            $settlements = [];
            $data = $this->getRequest()->getParams();
            if (isset($data['citiesRef'])) {
                $citiesRef = json_decode($data['citiesRef']);
                $searchData = $this->searchRepository->getItemBySearchKey(Search::SETTLEMENT_SEARCH_KEY);
                $searchData = $searchData->getEntityId()
                    ? json_decode($searchData->getSearchValue(), true)
                    : null;

                if ($searchData) {
                    foreach ($searchData as $city) {
                        if (in_array($city['Ref'], $citiesRef)) $settlements[] = $city;
                    }
                    $this->settlementRepository->syncLoadedSettlements($settlements);
                }
            }
        } catch (\Exception $exception) {
            $result->setData(['result' => '0', 'message' => __('Dont saved, try later')]);
        }

        return $result;
    }
}
