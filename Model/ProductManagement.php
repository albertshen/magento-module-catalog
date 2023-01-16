<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Model;

use Magento\Catalog\Model\ProductFactory;
use AlbertMage\Catalog\Api\Data\ProductInterfaceFactory;
use AlbertMage\Catalog\Api\ProductManagementInterface;

/**
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class ProductManagement implements ProductManagementInterface
{

    /**
     * @var ProductFactory
     */
    protected $productFactory;

    /**
     * @var ProductInterfaceFactory
     */
    protected $productInterfaceFactory;


    /**
     * @param ProductFactory $productFactory
     * @param ProductInterfaceFactory $productInterfaceFactory
     */
    public function __construct(
        ProductFactory $productFactory,
        ProductInterfaceFactory $productInterfaceFactory
    )
    {
        $this->productFactory = $productFactory;
        $this->productInterfaceFactory = $productInterfaceFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function createProductById($productId)
    {
        $product = $this->productFactory->create()->load($productId);
        return $this->createProduct($product);
    }

    /**
     * {@inheritdoc}
     */
    public function createProduct(\Magento\Catalog\Model\Product $product)
    {
        $newProduct = $this->productInterfaceFactory->create();
        $newProduct->setId($product->getId());
        $newProduct->setName($product->getName());
        $newProduct->setThumbnail($product->getMediaConfig()->getBaseMediaUrl() . $product->getThumbnail());
        $newProduct->setPrice($product->getPrice());
        return $newProduct;
    }
}
