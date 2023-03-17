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
interface SearchInterface
{

    const DEFAULT_PAGE = 1;

    const DEFAULT_PAGE_SIZE = 20;

    /**
     * Get product list by category
     *
     * @return \AlbertMage\Catalog\Api\Data\ProductSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function category();

    /**
     * Get product list by search
     *
     * @return \AlbertMage\Catalog\Api\Data\ProductSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function search();
}
