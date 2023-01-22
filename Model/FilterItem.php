<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Model;

use AlbertMage\Catalog\Api\Data\FilterItemInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Filter Item.
 *
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class FilterItem extends AbstractModel implements FilterItemInterface
{

    /**
     * {@inheritdoc}
     */
    public function getDisplay()
    {
        return $this->getData(self::KEY_DISPLAY);
    }

    /**
     * {@inheritdoc}
     */
    public function setDisplay($display)
    {
        return $this->setData(self::KEY_DISPLAY, $display);
    }

    /**
     * {@inheritdoc}
     */
    public function getValue()
    {
        return $this->getData(self::KEY_VALUE);
    }

    /**
     * {@inheritdoc}
     */
    public function setValue($value)
    {
        return $this->setData(self::KEY_VALUE, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function getCount()
    {
        return $this->getData(self::KEY_COUNT);
    }

    /**
     * {@inheritdoc}
     */
    public function setCount($count)
    {
        return $this->setData(self::KEY_COUNT, $count);
    }

    /**
     * {@inheritdoc}
     */
    public function getIsSelected()
    {
        return $this->getData(self::KEY_IS_SELECTED);
    }

    /**
     * {@inheritdoc}
     */
    public function setIsSelected($isSelected)
    {
        return $this->setData(self::KEY_IS_SELECTED, $isSelected);
    }

}
