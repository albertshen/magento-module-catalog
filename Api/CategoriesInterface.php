<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Catalog\Api;

/**
 * Interface ProductsInterface
 * @api
 * @since 101.0.0
 */
interface ProductsInterface
{
    /**
     * Get products
     *
     * @return array
     */
    public function getProducts();
}
