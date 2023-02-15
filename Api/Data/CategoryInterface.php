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

    const KEY_PRODUCT_COUNT = 'product_count';

    const KEY_URL = 'url';

    const KEY_THUMBNAIL = 'thumbnail';

    const KEY_CHILDREN = 'children';

    /**
     * Get category id
     *
     * @return int category id
     */
    public function getId();

    /**
     * Set category id
     *
     * @param int $categoryId
     * @return $this
     */
    public function setId($categoryId);

    /**
     * Returns the category name.
     *
     * @return string|null Category name. Otherwise, null.
     */
    public function getName();

    /**
     * Sets the category name.
     *
     * @param string $name
     * @return $this
     */
    public function setName($name);

    /**
     * Returns the product count.
     *
     * @return int|null Product count. Otherwise, null.
     */
    public function getProductCount();

    /**
     * Sets the product count.
     *
     * @param int $productCount
     * @return $this
     */
    public function setProductCount($productCount);

    /**
     * Returns url.
     *
     * @return string
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
     * Returns the category thumbnail.
     *
     * @return string Category thumbnail.
     */
    public function getThumbnail();

    /**
     * Sets the category thumbnail.
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
