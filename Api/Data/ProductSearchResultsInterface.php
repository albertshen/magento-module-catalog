<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Api\Data;

/**
 * Interface for node search results.
 * @api
 * @author Albert Shen <albertshen1206@gmail.com>
 */
interface ProductSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    const KEY_FILTER_OPTIONS = 'filter_options';

    /**
     * Get product list.
     *
     * @return \AlbertMage\Catalog\Api\Data\ProductListItemInterface[]
     */
    public function getItems();

    /**
     * Set product list.
     *
     * @param \AlbertMage\Catalog\Api\Data\ProductListItemInterface[] $items
     * @return $this
     */
    public function setItems(array $items);

    /**
     * Get filter list.
     *
     * @return \AlbertMage\Catalog\Api\Data\FilterInterface[]|null
     */
    public function getFilterOptions();

    /**
     * Set filter list.
     *
     * @param \AlbertMage\Catalog\Api\Data\FilterInterface[] $filterOptions
     * @return $this
     */
    public function setFilterOptions(array $filterOptions);
}
