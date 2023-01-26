<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Interface ProductMediaGallery
 * @author Albert Shen <albertshen1206@gmail.com>
 */
interface ProductMediaGalleryInterface extends ExtensibleDataInterface
{

    const MEDIA_TYPE = 'media_type';

    const IMAGE_URL = 'image_url';

    const VIDEO_PROVIDER = 'video_provider';

    const VIDEO_URL = 'video_provider';

    const VIDEO_TITLE = 'video_title';

    const VIDEO_DESCRIPTION = 'video_description';


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
