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
     *
     * @return array
     */
    public function getList($collection);
}
