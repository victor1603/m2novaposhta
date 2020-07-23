<?php


namespace CodeCustom\NovaPoshta\Controller\Adminhtml\System\Config;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\JsonFactory;
use CodeCustom\NovaPoshta\Model\Curl\Transport;
use CodeCustom\NovaPoshta\Model\Repository\City as CityRepository;

class City extends Action
{
    /**
     * @var JsonFactory
     */
    protected $jsonFactory;
    /**
     * @var CityRepository
     */
    protected $cityRepository;
    /**
     * @var Transport
     */
    protected $transport;

    public function __construct(
        Action\Context $context,
        JsonFactory $jsonFactory,
        CityRepository $cityRepository,
        Transport $transport
    )
    {
        $this->jsonFactory = $jsonFactory;
        $this->cityRepository = $cityRepository;
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
        $cities = $this->transport->loadApiData(CityRepository::NP_MODEL_NAME, CityRepository::NP_CALLED_METHOD);
        if (!$cities || empty($cities)) {
            $result->setData(['result' => false, 'message' => __('Cities not loaded from NP')]);
        } else {
            $resultSync = $this->cityRepository->syncLoadedCities($cities);
            $result->setData(['result' => $resultSync, 'message' => __('Successfully')]);
        }
        return $result;
    }
}
