<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Interface ProductListItem
 * @author Albert Shen <albertshen1206@gmail.com>
 */
interface ProductListItemInterface extends ExtensibleDataInterface
{

    const KEY_ID = 'id';

    const KEY_PRICE = 'price';

    const KEY_QTY = 'qty';

    const KEY_NAME = 'name';

    const KEY_THUMBNAIL = 'thumbnail';

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
     * Returns the product thumbnail.
     *
     * @return string Product thumbnail.
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
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \AlbertMage\Catalog\Api\Data\ProductListItemExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \AlbertMage\Catalog\Api\Data\ProductListItemExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(\AlbertMage\Catalog\Api\Data\ProductListItemExtensionInterface $extensionAttributes);
    
}
