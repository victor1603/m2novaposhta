<?php

namespace CodeCustom\NovaPoshta\Controller\Adminhtml\Config\Settlement;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action
{
    protected $pageFactory;

    public function __construct(
        Context $context,
        PageFactory $pageFactory

    )
    {
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPage = $this->pageFactory->create();
        $resultPage->setActiveMenu('CodeCustom_NovaPoshta::config');
        $resultPage->getConfig()->getTitle()->prepend(__('Edit city'));
        return $resultPage;
    }

}
