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

    const SKU = 'sku';

    const PRICE = 'price';

    const SPECIAL_PRICE = 'special_price';

    const AVAILABLE = 'available';

    const STOCK = 'stock';

    const CATEGORIES = 'categories';

    const COLOR = 'color';

    const SIZE = 'size';

    const PRE_ORDER_NOTE = 'pre_order_note';

    const DESCRIPTION = 'description';

    const THUMBNAIL = 'thumbnail';

    const MEDIA_GALLERY = 'media_gallery';

    const CONFIGURABLE_ATTRIBUTES = 'configurable_attributes';

    const ATTRIBUTES = 'attributes';

    const TYPE_ID = 'type_id';

    const OPTION_ID = 'option_id';

    const BUNDLE_OPTIONS = 'bundle_options';

    const CHILDREN_PRODUCTS = 'children_products';

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
     * Returns the categories.
     *
     * @return \AlbertMage\Catalog\Api\Data\ProductCategoriesInterface|null
     */
    public function getCategories();

    /**
     * Sets the product categories.
     *
     * @param string $categories
     * @return $this
     */
    public function setCategories($categories);

    // /**
    //  * Returns the product color.
    //  * Main Visual Swatch
    //  *
    //  * @return \AlbertMage\Catalog\Api\Data\ProductVisualSwatchInterface|null
    //  */
    // public function getVisualSwatch();

    // /**
    //  * Sets the product color.
    //  * Main Visual Swatch
    //  *
    //  * @param \AlbertMage\Catalog\Api\Data\ProductVisualSwatchInterface $color
    //  * @return $this
    //  */
    // public function setColor(\AlbertMage\Catalog\Api\Data\ProductVisualSwatchInterface $color);

    /**
     * Returns the product color.
     *
     * @return \AlbertMage\Catalog\Api\Data\ProductVisualSwatchInterface|null
     */
    public function getColor();

    /**
     * Sets the product color.
     *
     * @param \AlbertMage\Catalog\Api\Data\ProductVisualSwatchInterface $color
     * @return $this
     */
    public function setColor(\AlbertMage\Catalog\Api\Data\ProductVisualSwatchInterface $color);

    /**
     * Returns the product size.
     *
     * @return \AlbertMage\Catalog\Api\Data\ProductAttributeInterface|null
     */
    public function getSize();

    /**
     * Sets the product size.
     *
     * @param \AlbertMage\Catalog\Api\Data\ProductAttributeInterface $size
     * @return $this
     */
    public function setSize(\AlbertMage\Catalog\Api\Data\ProductAttributeInterface $size);

    /**
     * Returns the product preorder note.
     *
     * @return string|null
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
     * Returns the product description.
     *
     * @return string|null.
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
     * Returns the product thumbnail.
     *
     * @return string|null.
     */
    public function getThumbnail();

    /**
     * Sets the product thumbnail.
     *
     * @param string $thumbnail
     * @return $this
     */
    public function setThumbnail($thumbnail);

    /**
     * Returns the product mediaGallery.
     *
     * @return \AlbertMage\Catalog\Api\Data\ProductMediaInterface[]|null
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
     * Returns the configurable attributes.
     *
     * @return \AlbertMage\Catalog\Api\Data\ConfigurableOptionInterface[]|null
     */
    public function getConfigurableAttributes();

    /**
     * Sets the configurable attributes.
     *
     * @param \AlbertMage\Catalog\Api\Data\ConfigurableOptionInterface[] $attributes
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
     * Returns type id.
     *
     * @return string
     */
    public function getTypeId();

    /**
     * Sets type id.
     *
     * @param string $typeId
     * @return $this
     */
    public function setTypeId($typeId);

    /**
     * Returns the product optionId.
     *
     * @return string|null
     */
    public function getOptionId();

    /**
     * Sets the product optionId.
     *
     * @param string $optionId
     * @return $this
     */
    public function setOptionId($optionId);

    /**
     * Returns the product bundle options.
     *
     * @return \Magento\Bundle\Api\Data\OptionInterface[]|null
     */
    public function getBundleOptions();

    /**
     * Sets the product bundle options.
     *
     * @param \Magento\Bundle\Api\Data\OptionInterface[] $bundleOptions
     * @return $this
     */
    public function setBundleOptions($bundleOptions);

    /**
     * Returns the children-products.
     *
     * @return \AlbertMage\Catalog\Api\Data\ProductInterface[]|null.
     */
    public function getChildrenProducts();

    /**
     * Sets the children-products.
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
