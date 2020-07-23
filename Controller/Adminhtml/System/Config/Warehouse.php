<?php

namespace CodeCustom\NovaPoshta\Controller\Adminhtml\System\Config;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\JsonFactory;
use CodeCustom\NovaPoshta\Model\Curl\Transport;
use CodeCustom\NovaPoshta\Model\Repository\Warehouse as WarehouseRepository;

class Warehouse extends Action
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
     * @var WarehouseRepository
     */
    protected $warehouseRepository;

    public function __construct(
        Action\Context $context,
        JsonFactory $jsonFactory,
        Transport $transport,
        WarehouseRepository $warehouseRepository
    )
    {
        $this->jsonFactory = $jsonFactory;
        $this->transport = $transport;
        $this->warehouseRepository = $warehouseRepository;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Json|\Magento\Framework\Controller\ResultInterface
     * @throws \Exception
     */
    public function execute()
    {
        $result = $this->jsonFactory->create();
        $warehouses = $this->transport->loadApiData(WarehouseRepository::NP_MODEL_NAME, WarehouseRepository::NP_CALLED_METHOD);
        if (!$warehouses || empty($warehouses)) {
            $result->setData(['result' => false, 'message' => __('Warehouses not loaded from NP')]);
        } else {
            $resultSync = $this->warehouseRepository->syncLoadedWarehouses($warehouses);
            $result->setData(['result' => $resultSync, 'message' => __('Successfully')]);
        }
        return $result;
    }

}
