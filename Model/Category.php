<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Model;

use AlbertMage\Catalog\Api\Data\CategoryInterface;
use Magento\Framework\Api\AbstractExtensibleObject;

/**
 * Category.
 *
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class Category extends AbstractExtensibleObject implements CategoryInterface
{

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->_get(self::KEY_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function setId($productId)
    {
        return $this->setData(self::KEY_ID, $productId);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->_get(self::KEY_NAME);
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        return $this->setData(self::KEY_NAME, $name);
    }

    /**
     * {@inheritdoc}
     */
    public function getUrl()
    {
        return $this->_get(self::KEY_URL);
    }

    /**
     * {@inheritdoc}
     */
    public function setUrl($url)
    {
        return $this->setData(self::KEY_URL, $url);
    }

    /**
     * {@inheritdoc}
     */
    public function getThumbnail()
    {
        return $this->_get(self::KEY_THUMBNAIL);
    }

    /**
     * {@inheritdoc}
     */
    public function setThumbnail($thumbnail)
    {
        return $this->setData(self::KEY_THUMBNAIL, $thumbnail);
    }

    /**
     * {@inheritdoc}
     */
    public function getChildren()
    {
        return $this->_get(self::KEY_CHILDREN);
    }

    /**
     * {@inheritdoc}
     */
    public function setChildren($categories)
    {
        return $this->setData(self::KEY_CHILDREN, $categories);
    }

    /**
     * {@inheritdoc}
     *
     * @return \AlbertMage\Catalog\Api\Data\CategoryExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * {@inheritdoc}
     *
     * @param \AlbertMage\Catalog\Api\Data\CategoryExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(\AlbertMage\Catalog\Api\Data\CategoryExtensionInterface $extensionAttributes)
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

}
