<?php


namespace CodeCustom\NovaPoshta\Controller\Adminhtml\System\Config;

use CodeCustom\NovaPoshta\Model\Curl\Transport;
use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\JsonFactory;
use CodeCustom\NovaPoshta\Model\Repository\Area as AreaRepository;

class Area extends Action
{
    /**
     * @var JsonFactory
     */
    protected $jsonFactory;
    /**
     * @var AreaRepository
     */
    protected $areaRepository;
    /**
     * @var Transport
     */
    protected $transport;

    public function __construct(
        Action\Context $context,
        JsonFactory $jsonFactory,
        AreaRepository $areaRepository,
        Transport $transport
    )
    {
        $this->jsonFactory = $jsonFactory;
        $this->areaRepository = $areaRepository;
        $this->transport = $transport;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Json|\Magento\Framework\Controller\ResultInterface
     * @throws \Exception
     */
    public function execute()
    {
        $result = $this->jsonFactory->create();
        $areas = $this->transport->loadApiData(AreaRepository::NP_MODEL_NAME, AreaRepository::NP_CALLED_METHOD);
        if (!$areas || empty($areas)) {
            $result->setData(['result' => false, 'message' => __('Areas not loaded from NP')]);
        } else {
            $resultSync = $this->areaRepository->syncLoadedAreas($areas);
            $result->setData(['result' => $resultSync, 'message' => __('Successfully')]);
        }
        return $result;
    }

}
