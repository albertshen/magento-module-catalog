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
     * Get product id
     *
     * @return int product id
     */
    public function getId()
    {
        return $this->_get(self::ID);
    }

    /**
     * Set product id
     *
     * @param int $productId
     * @return $this
     */
    public function setId($productId)
    {
        return $this->setData(self::ID, $productId);
    }

    /**
     * Returns the product name.
     *
     * @return string|null Product name. Otherwise, null.
     */
    public function getName()
    {
        return $this->_get(self::NAME);
    }

    /**
     * Sets the product name.
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Returns the product price.
     *
     * @return float product price.
     */
    public function getPrice()
    {
        return $this->_get(self::PRICE);
    }

    /**
     * Sets the product price.
     *
     * @param float $price
     * @return $this
     */
    public function setPrice($price)
    {
        return $this->setData(self::PRICE, $price);
    }

    /**
     * Returns the product special price.
     *
     * @return float product special price.
     */
    public function getSpecialPrice()
    {
        return $this->_get(self::SPECIAL_PRICE);
    }

    /**
     * Sets the product special price.
     *
     * @param float $specialPrice
     * @return $this
     */
    public function setSpecialPrice($specialPrice)
    {
        return $this->setData(self::SPECIAL_PRICE, $specialPrice);
    }

    /**
     * Returns the product sku.
     *
     * @return string Product sku.
     */
    public function getSku()
    {
        return $this->_get(self::SKU);
    }

    /**
     * Sets the product sku.
     *
     * @param string $sku
     * @return $this
     */
    public function setSku($sku)
    {
        return $this->setData(self::SKU, $sku);
    }

    /**
     * Returns the product preorder note.
     *
     * @return string Product preorder note.
     */
    public function getPreOrderNote()
    {
        return $this->_get(self::PRE_ORDER_NOTE);
    }

    /**
     * Sets the product preorder note.
     *
     * @param string $preOrderNote
     * @return $this
     */
    public function setPreOrderNote($preOrderNote)
    {
        return $this->setData(self::PRE_ORDER_NOTE, $preOrderNote);
    } 

    /**
     * Returns the product color.
     *
     * @return \AlbertMage\Catalog\Api\Data\ProductColorInterface|null
     */
    public function getColor()
    {
        return $this->_get(self::COLOR);
    }

    /**
     * Sets the product size.
     *
     * @param \AlbertMage\Catalog\Api\Data\ProductColorInterface $color
     * @return $this
     */
    public function setColor(\AlbertMage\Catalog\Api\Data\ProductColorInterface $color)
    {
        return $this->setData(self::COLOR, $color);
    }

    /**
     * Returns the product size.
     *
     * @return \AlbertMage\Catalog\Api\Data\ProductSizeInterface|null
     */
    public function getSize()
    {
        return $this->_get(self::SIZE);
    }

    /**
     * Sets the product size.
     *
     * @param \AlbertMage\Catalog\Api\Data\ProductSizeInterface $size
     * @return $this
     */
    public function setSize(\AlbertMage\Catalog\Api\Data\ProductSizeInterface $size)
    {
        return $this->setData(self::SIZE, $size);
    }

    /**
     * Returns the product description.
     *
     * @return string Product description.
     */
    public function getDescription()
    {
        return $this->_get(self::DESCRIPTION);
    }

    /**
     * Sets the product description.
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * Returns the product mediaGallery.
     *
     * @return \AlbertMage\Catalog\Api\Data\ProductMediaGalleryItemInterface[]|null
     */
    public function getMediaGallery()
    {
        return $this->_get(self::MEDIA_GALLERY);
    }

    /**
     * Sets the product mediaGallery.
     *
     * @param \AlbertMage\Catalog\Api\Data\ProductMediaGalleryItemInterface[] $mediaGallery
     * @return $this
     */
    public function setMediaGallery(array $mediaGallery)
    {
        return $this->setData(self::MEDIA_GALLERY, $mediaGallery);
    }

    /**
     * Returns the product stock.
     *
     * @return int Product stock.
     */
    public function getStock()
    {
        return $this->_get(self::STOCK);
    }

    /**
     * Sets the product stock.
     *
     * @param int $stock
     * @return $this
     */
    public function setStock($stock)
    {
        return $this->setData(self::STOCK, $stock);
    }

    /**
     * Returns the product available.
     *
     * @return bool Product available.
     */
    public function getAvailable()
    {
        return $this->_get(self::AVAILABLE);
    }

    /**
     * Sets the product available.
     *
     * @param bool $available
     * @return $this
     */
    public function setAvailable($available)
    {
        return $this->setData(self::AVAILABLE, $available);
    }

    /**
     * Returns the product attributes.
     *
     * @return \AlbertMage\Catalog\Api\Data\ConfigurableAttributeInterface[]|null
     */
    public function getAttributes()
    {
        return $this->_get(self::ATTRIBUTES);
    }

    /**
     * Sets the product attributes.
     *
     * @param \AlbertMage\Catalog\Api\Data\ConfigurableAttributeInterface[] $attributes
     * @return $this
     */
    public function setAttributes(array $attributes)
    {
        return $this->setData(self::ATTRIBUTES, $attributes);
    }

    /**
     * Returns the sub-products.
     *
     * @return \Magento\Catalog\Api\Data\ProductInterface[]
     */
    public function getSubProducts()
    {
        return $this->_get(self::SUB_PRODUCTS);
    }

    /**
     * Sets the sub-products.
     *
     * @param \Magento\Catalog\Api\Data\ProductInterface[]|null $subProducts
     * @return $this
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
