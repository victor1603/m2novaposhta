<?php

namespace CodeCustom\NovaPoshta\Controller\Adminhtml\Config;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use CodeCustom\NovaPoshta\Model\Repository\Settlement as SettlementRepository;

class Settlement extends Action
{
    protected $pageFactory;

    protected $settlementRepository;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        SettlementRepository $settlementRepository
    )
    {
        $this->pageFactory = $pageFactory;
        $this->settlementRepository = $settlementRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->pageFactory->create();
        $resultPage->setActiveMenu('CodeCustom_NovaPoshta::config');
        $resultPage->getConfig()->getTitle()->prepend(__('Settlements grid'));
        return $resultPage;
    }

}
