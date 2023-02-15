<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Model\Product;

use AlbertMage\Catalog\Api\Data\ProductMediaInterface;
use Magento\Catalog\Model\AbstractModel;

/**
 * MediaGallery.
 *
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class Media extends AbstractModel implements ProductMediaInterface
{

    /**
     * {@inheritdoc}
     */
    public function getMediaType()
    {
        return $this->getData(self::MEDIA_TYPE);
    }

    /**
     * {@inheritdoc}
     */
    public function setMediaType($mediaType)
    {
        return $this->setData(self::MEDIA_TYPE, $mediaType);
    }

    /**
     * {@inheritdoc}
     */
    public function getImageUrl()
    {
        return $this->getData(self::IMAGE_URL);
    }

    /**
     * {@inheritdoc}
     */
    public function setImageUrl($imageUrl)
    {
        return $this->setData(self::IMAGE_URL, $imageUrl);
    }

    /**
     * {@inheritdoc}
     */
    public function getVideoProvider()
    {
        return $this->getData(self::VIDEO_PROVIDER);
    }

    /**
     * {@inheritdoc}
     */
    public function setVideoProvider($videoProvider)
    {
        return $this->setData(self::VIDEO_PROVIDER, $videoProvider);
    }


    /**
     * {@inheritdoc}
     */
    public function getVideoUrl()
    {
        return $this->getData(self::VIDEO_URL);
    }

    /**
     * {@inheritdoc}
     */
    public function setVideoUrl($videoUrl)
    {
        return $this->setData(self::VIDEO_URL, $videoUrl);
    }

    /**
     * {@inheritdoc}
     */
    public function getVideoTitle()
    {
        return $this->getData(self::VIDEO_TITLE);
    }

    /**
     * {@inheritdoc}
     */
    public function setVideoTitle($videoTitle)
    {
        return $this->setData(self::VIDEO_TITLE, $videoTitle);
    }

    /**
     * {@inheritdoc}
     */
    public function getVideoDescription()
    {
        return $this->getData(self::VIDEO_DESCRIPTION);
    }

    /**
     * {@inheritdoc}
     */
    public function setVideoDescription($videoDescription)
    {
        return $this->setData(self::VIDEO_DESCRIPTION, $videoDescription);
    }
}
