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

    const CACHE_PREFIX_PRODUCT = 'data.product';

    const CACHE_PREFIX_PRODUCT_DETAIL = 'data.product.detail';

    const CACHE_PREFIX_PRODUCT_CATEGORY_LIST = 'data.product.category_list';

    const CACHE_PREFIX_PRODUCT_SEARCH_LIST = 'data.product.search_list';

    const CACHE_PREFIX_PRODUCT_LIST = 'data.product.list';

    /**
     * Get product detail from system product id
     *
     * @param int $productId
     * @return \AlbertMage\Catalog\Api\Data\ProductInterface $product
     */
    public function getDetail($productId);

    /**
     * Get category list item from system product id
     *
     * @param int $productId
     * @return \AlbertMage\Catalog\Api\Data\ProductInterface $product
     */
    public function getCategoryListItem($productId);

    /**
     * Get search results list item from system product id
     *
     * @param int $productId
     * @return \AlbertMage\Catalog\Api\Data\ProductInterface $product
     */
    public function getSearchListItem($productId);

    /**
     * Get product list from system product id
     *
     * @param int $productId
     * @return \AlbertMage\Catalog\Api\Data\ProductInterface $product
     */
    public function getListItem($productId);
}
