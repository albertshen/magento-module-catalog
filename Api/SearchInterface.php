<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Api;

/**
 * Interface CategoryInterface
 * @api
 * @author Albert Shen <albertshen1206@gmail.com>
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
