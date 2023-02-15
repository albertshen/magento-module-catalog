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
     * Get product by id
     * 
     * @param int $productId
     * @return \AlbertMage\Catalog\Api\Data\ProductInterface
     */
    public function getProduct($productId);
}
