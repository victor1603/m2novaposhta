<?php

namespace CodeCustom\NovaPoshta\Controller\Adminhtml\Config\Settlement;

use CodeCustom\PureLogViewer\Api\LogPathRepositoryInterface;
use CodeCustom\PureLogViewer\Helper\FileSystem;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\Result\RawFactory;
use Magento\Framework\View\LayoutFactory;
use CodeCustom\NovaPoshta\Block\Adminhtml\Grid\CitySearch;

class Search extends Action
{
    /**
     * @var RawFactory
     */
    protected $rawFactory;

    /**
     * @var LayoutFactory
     */
    protected $layoutFactory;


    public function __construct(
        Context $context,
        RawFactory $rawFactory,
        LayoutFactory $layoutFactory
    )
    {
        $this->rawFactory = $rawFactory;
        $this->layoutFactory = $layoutFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Raw|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $content = $this->layoutFactory->create()
            ->createBlock(CitySearch::class);

        /** @var \Magento\Framework\Controller\Result\Raw $resultRaw */
        $resultRaw = $this->rawFactory->create();
        return $resultRaw->setContents($content->toHtml());
    }

}
