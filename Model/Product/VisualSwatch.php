<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Model\Product;

use AlbertMage\Catalog\Api\Data\ProductVisualSwatchInterface;

/**
 * Category.
 *
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class VisualSwatch extends Attribute implements ProductVisualSwatchInterface
{

    /**
     * {@inheritdoc}
     */
    public function getHashCode()
    {
        return $this->getData(self::HASH_CODE);
    }

    /**
     * {@inheritdoc}
     */
    public function setHashCode($hashCode)
    {
        return $this->setData(self::HASH_CODE, $hashCode);
    }

    /**
     * {@inheritdoc}
     */
    public function getSwatchImage()
    {
        return $this->getData(self::SWATCH_IMAGE);
    }

    /**
     * {@inheritdoc}
     */
    public function setSwatchImage($swatchImage)
    {
        return $this->setData(self::SWATCH_IMAGE, $swatchImage);
    }

}
