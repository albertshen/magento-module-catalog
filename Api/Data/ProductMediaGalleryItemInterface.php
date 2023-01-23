<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Api\Data;

/**
 * Interface ProductMediaGallery
 * @author Albert Shen <albertshen1206@gmail.com>
 */
interface ProductMediaGalleryItemInterface
{

    const KEY_TYPE = 'type';

    const KEY_SRC = 'src';

    /**
     * Get media type
     *
     * @return string
     */
    public function getType();

    /**
     * Set media type
     *
     * @param int $type
     * @return $this
     */
    public function setType($type);

    /**
     * Get media src
     *
     * @return string
     */
    public function getSrc();

    /**
     * Set media src
     *
     * @param int $src
     * @return $this
     */
    public function setSrc($src);

}
