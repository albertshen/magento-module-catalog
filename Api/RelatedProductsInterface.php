<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Api;

/**
 * Interface CategoryInterface
 * @api
 * @author Albert Shen <albertshen1206@gmail.com>
 */
interface RelatedProductsInterface
{

    const DEFAULT_LIMIT = 5;

    /**
     * Get related product list by product id
     *
     * @param int $productId
     * @return \AlbertMage\Catalog\Api\Data\ProductInterface[] $productList
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getRelatedProductsById($productId);
}
