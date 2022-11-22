<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Api;

/**
 * Interface CategoryListInterface
 * @api
 * @author Albert Shen <albertshen1206@gmail.com>
 */
interface CategoryListInterface
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
