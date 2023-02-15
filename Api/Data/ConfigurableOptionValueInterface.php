<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Api\Data;

/**
 * Interface ConfigurableOptionValue
 * @author Albert Shen <albertshen1206@gmail.com>
 */
interface ConfigurableOptionValueInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const VALUE_INDEX = 'value_index';

    const LABEL = 'label';

    const SWATCH_IMAGE = 'swatch_image';

    const PRODUCT_SUPER_ATTRIBUTE_ID = 'product_super_attribute_id';

    const DEFAULT_LABEL = 'default_label';

    const STORE_LABEL = 'store_label';

    const USE_DEFAULT_VALUE = 'use_default_value';

    /**
     * Get value index
     *
     * @return int
     */
    public function getValueIndex();

    /**
     * Set value index
     *
     * @param int $valueIndex
     * @return $this
     */
    public function setValueIndex($valueIndex);

    /**
     * Get label
     *
     * @return string
     */
    public function getLabel();

    /**
     * Set label
     *
     * @param string $label
     * @return $this
     */
    public function setLabel($label);

    /**
     * Get swatch image
     *
     * @return string|null
     */
    public function getSwatchImage();

    /**
     * Set swatch image
     *
     * @param string $swatchImage
     * @return $this
     */
    public function setSwatchImage($swatchImage);

    /**
     * Get product super attribute id
     *
     * @return string|null $productSuperAttributeId
     */
    public function getProductSuperAttributeId();

    /**
     * Set product super attribute id
     *
     * @param string $productSuperAttributeId
     * @return $this
     */
    public function setProductSuperAttributeId($productSuperAttributeId);

    /**
     * Get default label
     *
     * @return string|null
     */
    public function getDefaultLabel();

    /**
     * Set default label
     *
     * @param string $defaultLabel
     * @return $this
     */
    public function setDefaultLabel($defaultLabel);

    /**
     * Get store label
     *
     * @return string|null
     */
    public function getStoreLabel();

    /**
     * Set store label
     *
     * @param string $storeLabel
     * @return $this
     */
    public function setStoreLabel($storeLabel);

    /**
     * Get use default value
     *
     * @return bool|null
     */
    public function getUserDefaultValue();

    /**
     * Set use default value
     *
     * @param bool $useDefaultValue
     * @return $this
     */
    public function setUserDefaultValue($useDefaultValue);

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \AlbertMage\Catalog\Api\Data\ConfigurableOptionValueExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \AlbertMage\Catalog\Api\Data\ConfigurableOptionValueExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \AlbertMage\Catalog\Api\Data\ConfigurableOptionValueExtensionInterface $extensionAttributes
    );
}
