<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Api;

/**
 * Interface ProductGenerator
 * @author Albert Shen <albertshen1206@gmail.com>
 */
interface ProductGeneratorInterface
{
    /**
     * Get product detail from system product
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return \AlbertMage\Catalog\Api\Data\ProductInterface $product
     */
    public function getDetail(\Magento\Catalog\Model\Product $product);

    /**
     * Get category list item from system product
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return \AlbertMage\Catalog\Api\Data\ProductInterface $product
     */
    public function getCategoryListItem(\Magento\Catalog\Model\Product $product);

    /**
     * Get search results list item from system product
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return \AlbertMage\Catalog\Api\Data\ProductInterface $product
     */
    public function getSearchListItem(\Magento\Catalog\Model\Product $product);

    /**
     * Get list item from system product
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return \AlbertMage\Catalog\Api\Data\ProductInterface $product
     */
    public function getListItem(\Magento\Catalog\Model\Product $product);
}
