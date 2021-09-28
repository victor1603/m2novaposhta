<?php

namespace CodeCustom\NovaPoshta\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class Actions extends Column
{
    /**
     * Action Url`s
     */
    const URL_PATH_DELETE   = 'novaposhta/config_settlement/delete';
    const URL_PATH_EDIT     = 'novaposhta/config_settlement/edit';

    /**
     * @var UrlInterface
     */
    protected $urlInterface;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlInterface,
        array $components = [],
        array $data = []
    )
    {
        $this->urlInterface = $urlInterface;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');
                $item[$name]['edit'] = [
                    'href' => $this->urlInterface->getUrl(
                        self::URL_PATH_EDIT,
                        ['entity_id' => $item['entity_id']]
                    ),
                    'label' => __('Edit')
                ];

                $item[$name]['delete'] = [
                    'href' => $this->urlInterface->getUrl(
                        self::URL_PATH_DELETE,
                        ['entity_id' => $item['entity_id']]
                    ),
                    'label' => __('Delete'),
                    'confirm' => [
                        'title' => __('Delete city with ID %1', $item['entity_id']),
                        'message' => __('Are you sure you wan\'t to delete this record?')
                    ]
                ];

            }
        }

        return $dataSource;
    }
}
