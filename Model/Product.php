<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Model;

use AlbertMage\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Api\AbstractExtensibleObject;

/**
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class Product extends AbstractExtensibleObject implements ProductInterface
{

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->_get(self::ID);
    }

    /**
     * {@inheritdoc}
     */
    public function setId($productId)
    {
        return $this->setData(self::ID, $productId);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->_get(self::NAME);
    }

    /**
     * {@inheritdoc}
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * {@inheritdoc}
     */
    public function getPrice()
    {
        return $this->_get(self::PRICE);
    }

    /**
     * {@inheritdoc}
     */
    public function setPrice($price)
    {
        return $this->setData(self::PRICE, $price);
    }

    /**
     * {@inheritdoc}
     */
    public function getSpecialPrice()
    {
        return $this->_get(self::SPECIAL_PRICE);
    }

    /**
     * {@inheritdoc}
     */
    public function setSpecialPrice($specialPrice)
    {
        return $this->setData(self::SPECIAL_PRICE, $specialPrice);
    }

    /**
     * {@inheritdoc}
     */
    public function getSku()
    {
        return $this->_get(self::SKU);
    }

    /**
     * {@inheritdoc}
     */
    public function setSku($sku)
    {
        return $this->setData(self::SKU, $sku);
    }

    /**
     * {@inheritdoc}
     */
    public function getPreOrderNote()
    {
        return $this->_get(self::PRE_ORDER_NOTE);
    }

    /**
     * {@inheritdoc}
     */
    public function setPreOrderNote($preOrderNote)
    {
        return $this->setData(self::PRE_ORDER_NOTE, $preOrderNote);
    } 

    /**
     * {@inheritdoc}
     */
    public function getColor()
    {
        return $this->_get(self::COLOR);
    }

    /**
     * {@inheritdoc}
     */
    public function setColor(\AlbertMage\Catalog\Api\Data\ProductColorInterface $color)
    {
        return $this->setData(self::COLOR, $color);
    }

    /**
     * {@inheritdoc}
     */
    public function getSize()
    {
        return $this->_get(self::SIZE);
    }

    /**
     * {@inheritdoc}
     */
    public function setSize(\AlbertMage\Catalog\Api\Data\ProductSizeInterface $size)
    {
        return $this->setData(self::SIZE, $size);
    }

    /**
     * {@inheritdoc}
     */
    public function getDescription()
    {
        return $this->_get(self::DESCRIPTION);
    }

    /**
     * {@inheritdoc}
     */
    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * {@inheritdoc}
     */
    public function getMediaGallery()
    {
        return $this->_get(self::MEDIA_GALLERY);
    }

    /**
     * {@inheritdoc}
     */
    public function setMediaGallery(array $mediaGallery)
    {
        return $this->setData(self::MEDIA_GALLERY, $mediaGallery);
    }

    /**
     * {@inheritdoc}
     */
    public function getStock()
    {
        return $this->_get(self::STOCK);
    }

    /**
     * {@inheritdoc}
     */
    public function setStock($stock)
    {
        return $this->setData(self::STOCK, $stock);
    }

    /**
     * {@inheritdoc}
     */
    public function getAvailable()
    {
        return $this->_get(self::AVAILABLE);
    }

    /**
     * {@inheritdoc}
     */
    public function setAvailable($available)
    {
        return $this->setData(self::AVAILABLE, $available);
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigurableAttributes()
    {
        return $this->_get(self::CONFIGURABLE_ATTRIBUTES);
    }

    /**
     * {@inheritdoc}
     */
    public function setConfigurableAttributes(array $attributes)
    {
        return $this->setData(self::CONFIGURABLE_ATTRIBUTES, $attributes);
    }

    /**
     * {@inheritdoc}
     */
    public function getAttributes()
    {
        return $this->_get(self::ATTRIBUTES);
    }

    /**
     * {@inheritdoc}
     */
    public function setAttributes(array $attributes)
    {
        return $this->setData(self::ATTRIBUTES, $attributes);
    }

    /**
     * {@inheritdoc}
     */
    public function getTypeId()
    {
        return $this->_get(self::TYPE_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function setTypeId($typeId)
    {
        return $this->setData(self::TYPE_ID, $typeId);
    }


    /**
     * {@inheritdoc}
     */
    public function getSubProducts()
    {
        return $this->_get(self::SUB_PRODUCTS);
    }

    /**
     * {@inheritdoc}
     */
    public function setSubProducts($subProducts)
    {
        return $this->setData(self::SUB_PRODUCTS, $subProducts);
    }

    /**
     * {@inheritdoc}
     *
     * @return \AlbertMage\Catalog\Api\Data\ProductExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * {@inheritdoc}
     *
     * @param \AlbertMage\Catalog\Api\Data\ProductExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(\AlbertMage\Catalog\Api\Data\ProductExtensionInterface $extensionAttributes)
    {
        return $this->_setExtensionAttributes($extensionAttributes);
    }

}
