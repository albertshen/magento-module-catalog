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
     * Get product list from system product
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return \AlbertMage\Catalog\Api\Data\ProductInterface $product
     */
    public function getListItem(\Magento\Catalog\Model\Product $product);

    /**
     * Get product list from system product by id
     *
     * @param int $productId
     * @return \AlbertMage\Catalog\Api\Data\ProductInterface $product
     */
    public function getListItemById($productId);

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
     * Clean the detail cache
     *
     * @param int $productId
     * @return void
     */
    public function cleanDetailCache($productId);

    /**
     * Clean list item cache
     *
     * @param int $productId
     * @return void
     */
    public function cleanListItemCache($productId);

    /**
     * Clean product cache
     *
     * @param int $productId
     * @return void
     */
    public function cleanProductCache($productId);

    /**
     * Clean all product cache
     *
     * @param int $productId
     * @return void
     */
    public function cleanAllProductCache();
    
    /**
     * Refresh the detail cache
     *
     * @param int $productId
     * @return void
     */
    public function refreshDetailCache($productId);

    /**
     * Refresh list item cache
     *
     * @param int $productId
     * @return void
     */
    public function refreshListItemCache($productId);
    
    /**
     * Refresh category list item cache cache
     *
     * @param int $productId
     * @return void
     */
    public function refreshCategoryListItemCache($productId);

    /**
     * Refresh search list item cache
     *
     * @param int $productId
     * @return void
     */
    public function refreshSearchListItemCache($productId);

    /**
     * Refresh all list item cache cache
     *
     * @param int $productId
     * @return void
     */
    public function refreshAllProductCache($productId);
}
