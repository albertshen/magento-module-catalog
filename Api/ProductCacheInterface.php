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
interface ProductCacheInterface extends ProductManagementInterface
{

    const CACHE_EXPIRE_TIME = 7200;

    /**
     * Refresh product detail cache
     *
     * @param int $productId
     * @return void
     */
    public function refreshDetailCache($productId);

    /**
     * Refresh category list item cach
     *
     * @param int $productId
     * @return void
     */
    public function refreshCategoryListItemCache($productId);

    /**
     * Refresh search results list item cache
     *
     * @param int $productId
     * @return void
     */
    public function refreshSearchListItemCache($productId);

    /**
     * Refresh list item cache
     *
     * @param int $productId
     * @return void
     */
    public function refreshListItemCache($productId);

    /**
     * Refresh all product cache by product id
     *
     * @param int $productId
     * @return void
     */
    public function refreshAllProductCache($productId);

    /**
     * Clean all product cache
     *
     * @param int $productId
     * @return void
     */
    public function cleanAllProductCache();
    
}
