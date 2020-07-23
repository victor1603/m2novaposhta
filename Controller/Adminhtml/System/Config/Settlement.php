<?php

namespace CodeCustom\NovaPoshta\Controller\Adminhtml\System\Config;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\JsonFactory;
use CodeCustom\NovaPoshta\Model\Curl\Transport;
use CodeCustom\NovaPoshta\Model\Repository\Settlement as SettlementRepository;

class Settlement extends Action
{
    /**
     * @var JsonFactory
     */
    protected $jsonFactory;

    /**
     * @var Transport
     */
    protected $transport;

    /**
     * @var SettlementRepository
     */
    protected $settlementRepository;

    public function __construct(
        Action\Context $context,
        JsonFactory $jsonFactory,
        Transport $transport,
        SettlementRepository $settlementRepository
    )
    {
        $this->jsonFactory = $jsonFactory;
        $this->transport = $transport;
        $this->settlementRepository = $settlementRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $result = $this->jsonFactory->create();
        $settlements = $this->transport->loadApiData(SettlementRepository::NP_MODEL_NAME, SettlementRepository::NP_CALLED_METHOD);
        if (!$settlements || empty($settlements)) {
            $result->setData(['result' => false, 'message' => __('Settlements not loaded from NP')]);
        } else {
            $resultSync = $this->settlementRepository->syncLoadedSettlements($settlements);
            $result->setData(['result' => $resultSync, 'message' => __('Successfully')]);
        }
        return $result;
    }
}
