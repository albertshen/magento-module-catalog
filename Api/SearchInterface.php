<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Catalog\Api;

/**
 * Interface CategoryInterface
 * @api
 * @since 101.0.0
 */
interface SearchInterface
{
    /**
     * Get product list by search
     *
     * @return array
     */
    public function search();

    /**
     * Get product list by category
     *
     * @return array
     */
    public function category();
}
