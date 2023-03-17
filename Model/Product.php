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
    public function getQty()
    {
        return $this->_get(self::QTY);
    }

    /**
     * {@inheritdoc}
     */
    public function setQty($qty)
    {
        return $this->setData(self::QTY, $qty);
    }

    /**
     * {@inheritdoc}
     */
    public function getCategories()
    {
        return $this->_get(self::CATEGORIES);
    }

    /**
     * {@inheritdoc}
     */
    public function setCategories($categories)
    {
        return $this->setData(self::CATEGORIES, $stock);
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
    public function getColor()
    {
        return $this->_get(self::COLOR);
    }

    /**
     * {@inheritdoc}
     */
    public function setColor(\AlbertMage\Catalog\Api\Data\ProductVisualSwatchInterface $color)
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
    public function setSize(\AlbertMage\Catalog\Api\Data\ProductAttributeInterface $size)
    {
        return $this->setData(self::SIZE, $size);
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
    public function getThumbnail()
    {
        return $this->_get(self::THUMBNAIL);
    }

    /**
     * {@inheritdoc}
     */
    public function setThumbnail($thumbnail)
    {
        return $this->setData(self::THUMBNAIL, $thumbnail);
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
    public function getOptionId()
    {
        return $this->_get(self::OPTION_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function setOptionId($optionId)
    {
        return $this->setData(self::OPTION_ID, $optionId);
    }

    /**
     * {@inheritdoc}
     */
    public function getBundleOptions()
    {
        return $this->_get(self::BUNDLE_OPTIONS);
    }

    /**
     * {@inheritdoc}
     */
    public function setBundleOptions($bundleOptions)
    {
        return $this->setData(self::BUNDLE_OPTIONS, $bundleOptions);
    }


    /**
     * {@inheritdoc}
     */
    public function getChildrenProducts()
    {
        return $this->_get(self::CHILDREN_PRODUCTS);
    }

    /**
     * {@inheritdoc}
     */
    public function setChildrenProducts($childrenProducts)
    {
        return $this->setData(self::CHILDREN_PRODUCTS, $childrenProducts);
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
