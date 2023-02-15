<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Interface ProductMedia
 * @author Albert Shen <albertshen1206@gmail.com>
 */
interface ProductMediaInterface extends ExtensibleDataInterface
{

    const MEDIA_TYPE = 'media_type';

    const IMAGE_URL = 'image_url';

    const VIDEO_PROVIDER = 'video_provider';

    const VIDEO_URL = 'video_url';

    const VIDEO_TITLE = 'video_title';

    const VIDEO_DESCRIPTION = 'video_description';


    /**
     * Get media type
     *
     * @return string
     */
    public function getMediaType();

    /**
     * Set media type
     *
     * @param int $mediaType
     * @return $this
     */
    public function setMediaType($mediaType);

    /**
     * Get image url
     *
     * @return string
     */
    public function getImageUrl();

    /**
     * Set image url
     *
     * @param int $imageUrl
     * @return $this
     */
    public function setImageUrl($imageUrl);

    /**
     * Get video provider
     *
     * @return string|null
     */
    public function getVideoProvider();

    /**
     * Set video provider
     *
     * @param int $videoProvider
     * @return $this
     */
    public function setVideoProvider($videoProvider);

    /**
     * Get video url
     *
     * @return string|null
     */
    public function getVideoUrl();

    /**
     * Set video url
     *
     * @param int $videoUrl
     * @return $this
     */
    public function setVideoUrl($videoUrl);

    /**
     * Get video title
     *
     * @return string|null
     */
    public function getVideoTitle();

    /**
     * Set video title
     *
     * @param int $videoTitle
     * @return $this
     */
    public function setVideoTitle($videoTitle);

    /**
     * Get video description
     *
     * @return string|null
     */
    public function getVideoDescription();

    /**
     * Set video description
     *
     * @param int $videoDescription
     * @return $this
     */
    public function setVideoDescription($videoDescription);
}
