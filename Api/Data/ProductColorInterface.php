<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Api\Data;

/**
 * Interface ProductColor
 * @author Albert Shen <albertshen1206@gmail.com>
 */
interface ProductColorInterface extends ProductAttributeInterface
{

    /**
     * Get color image
     *
     * @return string color image
     */
    public function getImage();

    /**
     * Set color image
     *
     * @param string $image
     * @return $this
     */
    public function setImage($image);
    
}
