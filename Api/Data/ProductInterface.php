<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Api\Data;

/**
 * Interface Product
 * @author Albert Shen <albertshen1206@gmail.com>
 */
interface ProductInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const KEY_ID = 'id';

    const KEY_PRICE = 'price';

    const KEY_NAME = 'name';

    const KEY_SKU = 'sku';

    /**
     * Set product id
     *
     * @param int $productId
     * @return $this
     */
    public function setId($productId);

    /**
     * Get product id
     *
     * @return int product id
     */
    public function getId();

    /**
     * Returns the product.
     *
     * @return float product price.
     */
    public function getPrice();

    /**
     * Sets the product price.
     *
     * @param float $price
     * @return $this
     */
    public function setPrice($price);

    /**
     * Returns the product name.
     *
     * @return string|null Product name. Otherwise, null.
     */
    public function getName();

    /**
     * Sets the product name.
     *
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * Returns the product sku.
     *
     * @return string Product sku.
     */
    public function getSku();

    /**
     * Sets the product sku.
     *
     * @param string $sku
     * @return $this
     */
    public function setSku($sku);

    /**
     * Sets the product name.
     *
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * Returns the product sku.
     *
     * @return string Product sku.
     */
    public function getSku();

    /**
     * Sets the product sku.
     *
     * @param string $sku
     * @return $this
     */
    public function setSku($sku);

    /**
     * Returns the product mediaGallery.
     *
     * @return \AlbertMage\Catalog\Api\Data\ProductMediaGalleryItemInterface[].
     */
    public function getMediaGallery();

    /**
     * Sets the product mediaGallery.
     *
     * @param \AlbertMage\Catalog\Api\Data\ProductMediaGalleryItemInterface[] $mediaGallery
     * @return $this
     */
    public function setMediaGallery($mediaGallery);

    /**
     * Returns the childrenProducts.
     *
     * @return \AlbertMage\Catalog\Api\Data\ProductInterface[].
     */
    public function getChildrenProducts();

    /**
     * Sets the childrenProducts.
     *
     * @param \AlbertMage\Catalog\Api\Data\ProductInterface[] $childrenProducts
     * @return $this
     */
    public function setChildrenProducts($childrenProducts);

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \AlbertMage\Catalog\Api\Data\ProductExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \AlbertMage\Catalog\Api\Data\ProductExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(\AlbertMage\Catalog\Api\Data\ProductExtensionInterface $extensionAttributes);
    
}
