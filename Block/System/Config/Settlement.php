<?php


namespace CodeCustom\NovaPoshta\Block\System\Config;

use \Magento\Config\Block\System\Config\Form\Field;
use Magento\Framework\Data\Form\Element\AbstractElement;

class Settlement extends Field
{
    /**
     * @var string
     */
    protected $_template = 'CodeCustom_NovaPoshta::system/config/button/settlement.phtml';

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
                'id'                => 'settlement_sync',
                'button_label'      => _('Settlement sync'),
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
        return $this->getUrl('novaposhta/system_config/settlement');
    }
}
