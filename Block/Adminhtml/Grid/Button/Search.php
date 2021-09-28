<?php

namespace CodeCustom\NovaPoshta\Block\Adminhtml\Grid\Button;

use Magento\Cms\Block\Adminhtml\Page\Edit\GenericButton;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Search extends GenericButton implements ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label' => __('Search city in NovaPoshta DB'),
            'on_click' => sprintf("location.href= '%s';", $this->getBackUrl()),
            'class' => 'search',
            'sort_order' => 10
        ];
    }

    public function getBackUrl()
    {
        return $this->getUrl('*/*/');
    }
}
