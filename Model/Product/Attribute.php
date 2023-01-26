<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Model;

use AlbertMage\Catalog\Api\Data\ProductAttributeInterface;
use Magento\Catalog\Model\AbstractModel;

/**
 * Category.
 *
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class Attribute extends AbstractModel implements ProductAttributeInterface
{

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
    public function getValue()
    {
        return $this->getData(self::VALUE);
    }

    /**
     * {@inheritdoc}
     */
    public function setValue($value)
    {
        return $this->setData(self::VALUE, $value);
    }

}
