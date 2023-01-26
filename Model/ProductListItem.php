<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Model;

use AlbertMage\Catalog\Api\Data\ProductListItemInterface;
use Magento\Framework\Api\AbstractExtensibleObject;

/**
 * Product.
 *
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class ProductListItem extends AbstractExtensibleObject implements ProductListItemInterface
{

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
    public function getId()
    {
        return $this->_get(self::KEY_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function getPrice()
    {
        return $this->_get(self::KEY_PRICE);
    }

    /**
     * {@inheritdoc}
     */
    public function setPrice($price)
    {
        return $this->setData(self::KEY_PRICE, $price);
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
     *
     * @return \AlbertMage\Catalog\Api\Data\ProductListItemExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * {@inheritdoc}
     *
     * @param \AlbertMage\Catalog\Api\Data\ProductListItemExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(\AlbertMage\Catalog\Api\Data\ProductListItemExtensionInterface $extensionAttributes)
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

}
