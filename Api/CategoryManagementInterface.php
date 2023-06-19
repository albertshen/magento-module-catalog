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
interface CategoryManagementInterface
{
    /**
     * Get category tree
     *
     * @return \AlbertMage\Catalog\Api\Data\CategoryInterface[]
     */
    public function getCategoryTree();

    /**
     * Get category tree by id
     * 
     * @param int $catId
     * @return \AlbertMage\Catalog\Api\Data\CategoryInterface[]
     */
    public function getChildrenCategoriesById($catId);

    /**
     * Get category by id
     * 
     * @param int $catId
     * @return \AlbertMage\Catalog\Api\Data\CategoryInterface
     */
    public function getCategoryById($catId);
}
