<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Interface Category
 * @author Albert Shen <albertshen1206@gmail.com>
 */
interface CategoryInterface extends ExtensibleDataInterface
{

    const KEY_ID = 'id';

    const KEY_NAME = 'name';

    const KEY_URL = 'url';

    const KEY_THUMBNAIL = 'thumbnail';

    const KEY_CHILDREN = 'children';

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
     * Returns url.
     *
     * @return string url.
     */
    public function getUrl();

    /**
     * Sets url.
     *
     * @param string $url
     * @return $this
     */
    public function setUrl($url);

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
     * Returns the sub categories.
     *
     * @return \AlbertMage\Catalog\Api\Data\CategoryInterface[]|null
     */
    public function getChildren();

    /**
     * Sets the sub categories.
     *
     * @param \AlbertMage\Catalog\Api\Data\CategoryInterface[] $categories
     * @return $this
     */
    public function setChildren($categories);

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \AlbertMage\Catalog\Api\Data\CategoryExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \AlbertMage\Catalog\Api\Data\CategoryExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(\AlbertMage\Catalog\Api\Data\CategoryExtensionInterface $extensionAttributes);
    
}
