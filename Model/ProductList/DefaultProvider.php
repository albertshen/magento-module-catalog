<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Catalog\Model\ProductList;

/**
 * Interface ProductListInterface
 * @api
 * @since 101.0.0
 */
class DefaultProvider implements \AlbertMage\Catalog\Model\ProductListInterface
{
    /**
     * @inheritdoc
     */
    public function getList($collection)
    {
        $data = [];
        foreach($collection as $item) {
            $data[] = [
                'name' => $item->getName()
            ];
        }
        return $data;
    }

}
