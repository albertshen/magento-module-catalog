<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Model;

use AlbertMage\Catalog\Api\Data\FilterInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * Filter.
 *
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class Filter extends AbstractModel implements FilterInterface
{

    /**
     * {@inheritdoc}
     */
    public function getField()
    {
        return $this->getData(self::KEY_FIELD);
    }

    /**
     * {@inheritdoc}
     */
    public function setField($field)
    {
        return $this->setData(self::KEY_FIELD, $field);
    }

    /**
     * {@inheritdoc}
     */
    public function getLabel()
    {
        return $this->getData(self::KEY_LABEL);
    }

    /**
     * {@inheritdoc}
     */
    public function setLabel($label)
    {
        return $this->setData(self::KEY_LABEL, $label);
    }

    /**
     * {@inheritdoc}
     */
    public function getItems()
    {
        return $this->getData(self::KEY_ITEMS);
    }

    /**
     * {@inheritdoc}
     */
    public function setItems($items)
    {
        return $this->setData(self::KEY_ITEMS, $items);
    }

}
