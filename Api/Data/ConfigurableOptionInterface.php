<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Api\Data;

/**
 * Interface ConfigurableOption
 * Reference to Magento\ConfigurableProduct\Api\Data\OptionInterface
 * 
 * @author Albert Shen <albertshen1206@gmail.com>
 */
interface ConfigurableOptionInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{

    const ATTRIBUTE_ID = 'attribute_id';

    const LABEL = 'label';

    const CODE = 'code';

    const IS_VISUAL_SWATCH = 'is_visual_swatch';

    const VALUES = 'values';

    /**
     * Get attribute id
     *
     * @return int
     */
    public function getId();

    /**
     * Set attribute id
     *
     * @param int $attributeId
     * @return $this
     */
    public function setId($attributeId);

    /**
     * Get attribute label
     *
     * @return string
     */
    public function getLabel();

    /**
     * Set attribute label
     *
     * @param string $label
     * @return $this
     */
    public function setLabel($label);

    /**
     * Get attribute code
     *
     * @return string
     */
    public function getCode();

    /**
     * Set attribute code
     *
     * @param string $code
     * @return $this
     */
    public function setCode($code);

    /**
     * Get attribute isVisualSwatch
     *
     * @return bool|null
     */
    public function getIsVisualSwatch();

    /**
     * Set attribute isVisualSwatch
     *
     * @param bool $isVisualSwatch
     * @return $this
     */
    public function setIsVisualSwatch($isVisualSwatch);
    
    /**
     * Get attribute values
     *
     * @return \AlbertMage\Catalog\Api\Data\ConfigurableOptionValueInterface[]|null
     */
    public function getValues();

    /**
     * Set attribute values
     *
     * @param \AlbertMage\Catalog\Api\Data\ConfigurableOptionValueInterface[] $values
     * @return $this
     */
    public function setValues($values);

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \AlbertMage\Catalog\Api\Data\ConfigurableOptionExtensionInterface|null
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \AlbertMage\Catalog\Api\Data\ConfigurableOptionExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \AlbertMage\Catalog\Api\Data\ConfigurableOptionExtensionInterface $extensionAttributes
    );

}
