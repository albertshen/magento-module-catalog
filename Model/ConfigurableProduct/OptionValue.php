<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Model\ConfigurableProduct;

use AlbertMage\Catalog\Api\Data\ConfigurableOptionValueInterface;
use Magento\Framework\Model\AbstractExtensibleModel;

/**
 * Category.
 *
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class OptionValue extends AbstractExtensibleModel implements ConfigurableOptionValueInterface
{

    /**
     * {@inheritdoc}
     */
    public function getValueIndex()
    {
        return $this->getData(self::VALUE_INDEX);
    }

    /**
     * {@inheritdoc}
     */
    public function setValueIndex($valueIndex)
    {
        return $this->setData(self::VALUE_INDEX, $valueIndex);
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return $this->getData(self::LABEL);
    }

    /**
     * {@inheritdoc}
     */
    public function setLabel($label)
    {
        return $this->setData(self::LABEL, $label);
    }

    /**
     * {@inheritdoc}
     */
    public function getSwatchImage()
    {
        return $this->getData(self::SWATCH_IMAGE);
    }

    /**
     * {@inheritdoc}
     */
    public function setSwatchImage($swatchImage)
    {
        return $this->setData(self::SWATCH_IMAGE, $swatchImage);
    }

    /**
     * {@inheritdoc}
     */
    public function getProductSuperAttributeId()
    {
        return $this->getData(self::PRODUCT_SUPER_ATTRIBUTE_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function setProductSuperAttributeId($productSuperAttributeId)
    {
        return $this->setData(self::PRODUCT_SUPER_ATTRIBUTE_ID, $productSuperAttributeId);
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultLabel()
    {
        return $this->getData(self::DEFAULT_LABEL);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultLabel($defaultLabel)
    {
        return $this->setData(self::DEFAULT_LABEL, $defaultLabel);
    }

    /**
     * {@inheritdoc}
     */
    public function getStoreLabel()
    {
        return $this->getData(self::STORE_LABEL);
    }

    /**
     * {@inheritdoc}
     */
    public function setStoreLabel($storeLabel)
    {
        return $this->setData(self::STORE_LABEL, $storeLabel);
    }

    /**
     * {@inheritdoc}
     */
    public function getUserDefaultValue()
    {
        return $this->getData(self::USE_DEFAULT_VALUE);
    }

    /**
     * {@inheritdoc}
     */
    public function setUserDefaultValue($useDefaultValue)
    {
        return $this->setData(self::USE_DEFAULT_VALUE, $useDefaultValue);
    }

    /**
     * {@inheritdoc}
     *
     * @return \AlbertMage\Catalog\Api\Data\ConfigurableOptionValueExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * {@inheritdoc}
     *
     * @param \AlbertMage\Catalog\Api\Data\ConfigurableOptionValueExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \AlbertMage\Catalog\Api\Data\ConfigurableOptionValueExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}
