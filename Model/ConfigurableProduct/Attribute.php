<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Model\ConfigurableProduct;

use AlbertMage\Catalog\Api\Data\ConfigurableAttributeInterface;
use Magento\Framework\Model\AbstractExtensibleModel;

/**
 * Category.
 *
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class Attribute extends AbstractExtensibleModel implements ConfigurableAttributeInterface
{

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getData(self::ATTRIBUTE_ID);
    }

    /**
     * {@inheritdoc}
     */
    public function setId($attributeId)
    {
        return $this->setData(self::ATTRIBUTE_ID, $attributeId);
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
    public function getCode()
    {
        return $this->getData(self::CODE);
    }

    /**
     * {@inheritdoc}
     */
    public function setCode($code)
    {
        return $this->setData(self::CODE, $code);
    }

    /**
     * {@inheritdoc}
     */
    public function getValues()
    {
        return $this->getData(self::VALUES);
    }

    /**
     * {@inheritdoc}
     */
    public function setValues($values)
    {
        return $this->setData(self::VALUES, $values);
    }

    /**
     * {@inheritdoc}
     *
     * @return \AlbertMage\Catalog\Api\Data\ConfigurableAttributeExtensionInterface|null
     */
    public function getExtensionAttributes()
    {
        return $this->_getExtensionAttributes();
    }

    /**
     * {@inheritdoc}
     *
     * @param \AlbertMage\Catalog\Api\Data\ConfigurableAttributeExtensionInterface $extensionAttributes
     * @return $this
     */
    public function setExtensionAttributes(
        \AlbertMage\Catalog\Api\Data\ConfigurableAttributeExtensionInterface $extensionAttributes
    ) {
        return $this->_setExtensionAttributes($extensionAttributes);
    }
}
