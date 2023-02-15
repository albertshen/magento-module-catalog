<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Model\Product;

use AlbertMage\Catalog\Api\Data\ProductColorInterface;

/**
 * Category.
 *
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class Color extends Attribute implements ProductColorInterface
{

    /**
     * {@inheritdoc}
     */
    public function getImage()
    {
        return $this->getData(self::IMAGE);
    }

    /**
     * {@inheritdoc}
     */
    public function setImage($image)
    {
        return $this->setData(self::IMAGE, $image);
    }

}
