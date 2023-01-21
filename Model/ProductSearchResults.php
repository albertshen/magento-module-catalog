<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
declare(strict_types=1);

namespace AlbertMage\Catalog\Model;

use AlbertMage\Catalog\Api\Data\ProductSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Service Data Object with product item search results.
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class ProductSearchResults extends SearchResults implements ProductSearchResultsInterface
{
    /**
     * {@inheritdoc}
     */
    public function getFilterOptions()
    {
        return $this->_get(self::KEY_FILTER_OPTIONS);
    }

    /**
     * {@inheritdoc}
     */
    public function setFilterOptions(array $filterOptions)
    {
        return $this->setData(self::KEY_FILTER_OPTIONS, $filterOptions);
    }
}
