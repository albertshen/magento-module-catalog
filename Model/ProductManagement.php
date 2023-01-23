<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Model;

use Magento\Catalog\Model\ProductFactory;
use AlbertMage\Catalog\Api\Data\ProductListItemInterfaceFactory;
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
     * @var ProductListItemInterfaceFactory
     */
    protected $productListItemInterfaceFactory;


    /**
     * @param ProductFactory $productFactory
     * @param ProductListItemInterfaceFactory $productListItemInterfaceFactory
     */
    public function __construct(
        ProductFactory $productFactory,
        ProductListItemInterfaceFactory $productListItemInterfaceFactory
    )
    {
        $this->productFactory = $productFactory;
        $this->productListItemInterfaceFactory = $productListItemInterfaceFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function createProductListItemById($productId)
    {
        $product = $this->productFactory->create()->load($productId);
        return $this->createProductListItem($product);
    }

    /**
     * {@inheritdoc}
     */
    public function createProductListItem(\Magento\Catalog\Model\Product $product)
    {
        $newProduct = $this->productListItemInterfaceFactory->create();
        $newProduct->setId($product->getId());
        $newProduct->setName($product->getName());
        $newProduct->setThumbnail($product->getMediaConfig()->getBaseMediaUrl() . $product->getThumbnail());
        $newProduct->setPrice($product->getPrice());
        return $newProduct;
    }
}
