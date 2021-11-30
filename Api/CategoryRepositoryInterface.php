<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Catalog\Api;

/**
 * Interface CategoryRepositoryInterface
 * @api
 * @since 101.0.0
 */
interface CategoryRepositoryInterface
{
    /**
     * Get category tree
     *
     * @return array
     */
    public function getCategoryTree();

    /**
     * Get category tree by id
     * @param int $catId
     * @return array
     */
    public function getCategoryTreeById($catId);
}
