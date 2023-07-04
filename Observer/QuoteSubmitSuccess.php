<?php

namespace AlbertMage\Catalog\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use AlbertMage\Catalog\Api\ProductManagementInterface;

class QuoteSubmitSuccess implements ObserverInterface
{

    /**
     * @var ProductManagementInterface
     */
    private $productManagement;

    /**
     * @param ProductManagementInterface $productManagement
     */
    public function __construct(
        ProductManagementInterface $productManagement
    ) {
        $this->productManagement = $productManagement;
    }

    /**
     * @param Observer $observer
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function execute(Observer $observer)
    {
        $quote = $observer->getEvent()->getQuote();
        foreach ($quote->getAllItems() as $item) {
            $this->productManagement->cleanProductCache($item->getProductId());
        }
    }

}