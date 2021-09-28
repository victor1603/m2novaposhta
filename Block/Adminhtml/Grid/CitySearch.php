<?php

namespace CodeCustom\NovaPoshta\Block\Adminhtml\Grid;

use CodeCustom\NovaPoshta\Model\Search;
use Magento\Framework\View\Element\Template;
use CodeCustom\NovaPoshta\Model\Curl\Transport;
use CodeCustom\NovaPoshta\Api\Data\SearchInterface;
use CodeCustom\NovaPoshta\Api\SearchRepositoryInterface;

class CitySearch extends Template
{
    public $_template = 'CodeCustom_NovaPoshta::grid/city_search.phtml';

    /**
     * @var Transport
     */
    protected $transport;

    /**
     * @var SearchInterface
     */
    protected $search;

    /**
     * @var SearchRepositoryInterface
     */
    protected $searchRepository;

    public function __construct(
        Template\Context $context,
        Transport $transport,
        SearchInterface $search,
        SearchRepositoryInterface $searchRepository,
        array $data = []
    )
    {
        $this->transport = $transport;
        $this->search = $search;
        $this->searchRepository = $searchRepository;
        parent::__construct($context, $data);
    }

    /**
     * @return false|mixed|null
     * @throws \Exception
     */
    public function getSettlementData()
    {
        if (!$this->getRequest()->getParam('ajax')) {
            return false;
        }
        $data = $this->transport->loadApiData(
            Transport::ADDRESS_GENERAL,
            Transport::METHOD_SETTLEMENT,
            ['FindByString' => $this->getRequest()->getParam('city')]
        );

        if ($data) {
            $item = $this->searchRepository->getItemBySearchKey(Search::SETTLEMENT_SEARCH_KEY);
            $item->setSearchKey('settlement_search');
            $item->setSearchValue(json_encode($data, JSON_UNESCAPED_UNICODE));
            $this->searchRepository->save($item);
        }

        return $data ? $data : null;
    }

    /**
     * @return string
     */
    public function getAjaxUrl()
    {
        return $this->getUrl('novaposhta/config_settlement/search');
    }

    public function getSaveUrl()
    {
        return $this->getUrl('novaposhta/config_settlement/save');
    }

    public function getRedirectUrl()
    {
        return $this->getUrl('novaposhta/config/settlement');
    }
}
