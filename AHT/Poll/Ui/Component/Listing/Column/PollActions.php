<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\Poll\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;

/**
 * Class PageActions
 */
class PollActions extends Column
{

    /** @var UrlInterface */
    protected $urlBuilder;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlBuilder $actionUrlBuilder
     * @param UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     * @param string $editUrl
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');
                if (isset($item['poll_id'])) {
                    $item[$name]['edit'] = [
                        'href' => $this->urlBuilder->getUrl("poll/index/edit", ['id' => $item['poll_id']]),
                        'label' => __('Edit')
                    ];

                     $item[$name]['detail'] = [
                        'href' => $this->urlBuilder->getUrl("poll/index/detail", ['id' => $item['poll_id']]),
                        'label' => __('Detail')
                    ];

                      $item[$name]['addanswer'] = [
                        'href' => $this->urlBuilder->getUrl("poll/index/addanswer", ['poll_id' => $item['poll_id']]),
                        'label' => __('Add Answer')
                    ];

                     $item[$name]['editanswer'] = [
                        'href' => $this->urlBuilder->getUrl("poll/index/answer", ['id' => $item['poll_id']]),
                        'label' => __('List Answer')
                    ];

                    $item[$name]['delete'] = [
                        'href' => $this->urlBuilder->getUrl("poll/index/delete", ['id' => $item['poll_id']]),
                        'label' => __('Delete'),
                        'confirm' => [
                            'title' => __('Delete ${ $.$data.poll_title }'),
                            'message' => __('Are you sure you wan\'t to delete a ${ $.$data.poll_title } record?')
                        ]
                    ];

                }
            }
        }
        return $dataSource;
    }
}
