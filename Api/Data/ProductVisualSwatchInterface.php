<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Api\Data;

use AlbertMage\Catalog\Api\Data\ProductAttributeInterface;

/**
 * Interface ProductVisualSwatch
 * @author Albert Shen <albertshen1206@gmail.com>
 */
interface ProductVisualSwatchInterface extends ProductAttributeInterface
{

    const HASH_CODE = 'hash_code';

    const SWATCH_IMAGE = 'swatch_image';

    /**
     * Get color hash code
     *
     * @return string|null
     */
    public function getHashCode();

    /**
     * Set color hash code
     *
     * @param string $hashCode
     * @return $this
     */
    public function setHashCode($hashCode);

    /**
     * Get swatch image
     *
     * @return string|null
     */
    public function getSwatchImage();

    /**
     * Set swatch image
     *
     * @param string $swatchImage
     * @return $this
     */
    public function setSwatchImage($swatchImage);
    
}
