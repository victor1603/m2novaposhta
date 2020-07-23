<?php


namespace CodeCustom\NovaPoshta\Block\System\Config;

use \Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class Warehouse extends Field
{
    /**
     * @var string
     */
    protected $_template = 'CodeCustom_NovaPoshta::system/config/button/warehouse.phtml';

    /**
     * Remove scope label
     *
     * @param  AbstractElement $element
     * @return string
     */
    public function render(AbstractElement $element)
    {
        $element->unsScope()->unsCanUseWebsiteValue()->unsCanUseDefaultValue();
        return parent::render($element);
    }

    /**
     * @param AbstractElement $element
     * @return string
     */
    protected function _getElementHtml(AbstractElement $element)
    {
        $this->addData(
            [
                'id'                => 'warehouse_sync',
                'button_label'      => _('Warehouse sync'),
                'html_id'           => $element->getHtmlId()
            ]
        );
        return $this->_toHtml();
    }

    /**
     * get ajax url
     * @return string
     */
    public function getAjaxUrl()
    {
        return $this->getUrl('novaposhta/system_config/warehouse');
    }
}
