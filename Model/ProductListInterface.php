<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Catalog\Model;

/**
 * Interface ProductListInterface
 * @api
 * @since 101.0.0
 */
interface ProductListInterface
{
    /**
     * Get product list
     * @param \Magento\Catalog\Model\ResourceModel\Product\Collection
     * @return array
     */
    public function getList(\Magento\Catalog\Model\ResourceModel\Product\Collection $collection);
}
