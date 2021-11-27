<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Catalog\Api;

/**
 * Interface CategoriesInterface
 * @api
 * @since 101.0.0
 */
interface CategoriesInterface
{
    /**
     * Get categories
     *
     * @return array
     */
    public function getCategories();
}
