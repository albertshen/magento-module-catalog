<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Catalog\Api;

/**
 * Interface ProductRepositoryInterface
 * @api
 * @since 101.0.0
 */
interface ProductRepositoryInterface
{
    /**
     * Get list
     *
     * @return array
     */
    public function getList();
}
