<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Interface Product
 * @author Albert Shen <albertshen1206@gmail.com>
 */
interface ProductInterface extends ExtensibleDataInterface
{

    const ID = 'id';

    const NAME = 'name';

    const PRICE = 'price';

    const SPECIAL_PRICE = 'special_price';

    const SKU = 'sku';

    const PRE_ORDER_NOTE = 'pre_order_note';

    const COLOR = 'color';

    const SIZE = 'size';

    const DESCRIPTION = 'description';

    const MEDIA_GALLERY = 'media_gallery';

    const STOCK = 'stock';

    const AVAILABLE = 'available';

    const CONFIGURABLE_ATTRIBUTES = 'configurable_attributes';

    const ATTRIBUTES = 'attributes';

    const SUB_PRODUCTS = 'sub_products';

    /**
     * Get product id
     *
     * @return int product id
     */
    public function getId();

    /**
     * Set product id
     *
     * @param int $productId
     * @return $this
     */
    public function setId($productId);

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
     * Returns the product price.
     *
     * @return float|null product price.
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
     * Returns the product special price.
     *
     * @return float|null product special price.
     */
    public function getSpecialPrice();

    /**
     * Sets the product special price.
     *
     * @param float $specialPrice
     * @return $this
     */
    public function setSpecialPrice($specialPrice);

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
     * Returns the product preorder note.
     *
     * @return string|null Product preorder note.
     */
    public function getPreOrderNote();

    /**
     * Sets the product preorder note.
     *
     * @param string $preOrderNote
     * @return $this
     */
    public function setPreOrderNote($preOrderNote);

    /**
     * Returns the product color.
     *
     * @return \AlbertMage\Catalog\Api\Data\ProductColorInterface|null
     */
    public function getColor();

    /**
     * Sets the product color.
     *
     * @param \AlbertMage\Catalog\Api\Data\ProductColorInterface $color
     * @return $this
     */
    public function setColor(\AlbertMage\Catalog\Api\Data\ProductColorInterface $color);

    /**
     * Returns the product size.
     *
     * @return \AlbertMage\Catalog\Api\Data\ProductSizeInterface|null
     */
    public function getSize();

    /**
     * Sets the product size.
     *
     * @param \AlbertMage\Catalog\Api\Data\ProductSizeInterface $size
     * @return $this
     */
    public function setSize(\AlbertMage\Catalog\Api\Data\ProductSizeInterface $size);

    /**
     * Returns the product description.
     *
     * @return string Product description.
     */
    public function getDescription();

    /**
     * Sets the product description.
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description);

    /**
     * Returns the product mediaGallery.
     *
     * @return \AlbertMage\Catalog\Api\Data\ProductMediaInterface[].
     */
    public function getMediaGallery();

    /**
     * Sets the product mediaGallery.
     *
     * @param \AlbertMage\Catalog\Api\Data\ProductMediaInterface[] $mediaGallery
     * @return $this
     */
    public function setMediaGallery(array $mediaGallery);

    /**
     * Returns the product stock.
     *
     * @return int|null Product stock.
     */
    public function getStock();

    /**
     * Sets the product stock.
     *
     * @param int $stock
     * @return $this
     */
    public function setStock($stock);

    /**
     * Returns the product available.
     *
     * @return bool Product available.
     */
    public function getAvailable();

    /**
     * Sets the product available.
     *
     * @param bool $available
     * @return $this
     */
    public function setAvailable($available);

    /**
     * Returns the configurable attributes.
     *
     * @return \AlbertMage\Catalog\Api\Data\ConfigurableAttributeInterface[]|null
     */
    public function getConfigurableAttributes();

    /**
     * Sets the configurable attributes.
     *
     * @param \AlbertMage\Catalog\Api\Data\ConfigurableAttributeInterface[] $attributes
     * @return $this
     */
    public function setConfigurableAttributes(array $attributes);

    /**
     * Returns the product attributes.
     *
     * @return \AlbertMage\Catalog\Api\Data\ProductAttributeInterface[]|null
     */
    public function getAttributes();

    /**
     * Sets the product attributes.
     *
     * @param \AlbertMage\Catalog\Api\Data\ProductAttributeInterface[] $attributes
     * @return $this
     */
    public function setAttributes(array $attributes);

    /**
     * Returns the sub-products.
     *
     * @return \AlbertMage\Catalog\Api\Data\ProductInterface[]|null.
     */
    public function getSubProducts();

    /**
     * Sets the sub-products.
     *
     * @param \AlbertMage\Catalog\Api\Data\ProductInterface[] $subProducts
     * @return $this
     */
    public function setSubProducts($subProducts);

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
