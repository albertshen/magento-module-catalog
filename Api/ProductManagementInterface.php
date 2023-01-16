<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Api;

/**
 * Interface ProductManagement
 * @api
 * @author Albert Shen <albertshen1206@gmail.com>
 */
interface ProductManagementInterface
{

    /**
     * Create product by id
     * 
     * @param int $productId
     * @return \AlbertMage\Catalog\Api\Data\ProductInterface
     */
    public function createProductById($productId);

    /**
     * Create product
     * 
     * @param \Magento\Catalog\Model\Product
     * @return \AlbertMage\Catalog\Api\Data\ProductInterface
     */
    public function createProduct(\Magento\Catalog\Model\Product $product);
}
