<?php

namespace AlbertMage\Catalog\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use AlbertMage\Catalog\Api\ProductManagementInterface;

class CancelOrderItem implements ObserverInterface
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
        $productId = $observer->getEvent()->getItem()->getProductId();
        $this->productManagement->cleanProductCache($productId);
    }

}