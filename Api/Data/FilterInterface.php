<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Api\Data;

/**
 * Interface Filter
 * @author Albert Shen <albertshen1206@gmail.com>
 */
interface FilterInterface
{

    const KEY_FIELD = 'field';

    const KEY_LABEL = 'label';

    const KEY_ITEMS = 'items';

    /**
     * Returns field name.
     *
     * @return string.
     */
    public function getField();

    /**
     * Sets the field name.
     *
     * @param string $field
     * @return $this
     */
    public function setField($field);

    /**
     * Returns label name.
     *
     * @return string.
     */
    public function getLabel();

    /**
     * Sets the label name.
     *
     * @param string $label
     * @return $this
     */
    public function setLabel($label);

    /**
     * Returns filter items.
     *
     * @return \AlbertMage\Catalog\Api\Data\FilterItemInterface[].
     */
    public function getItems();

    /**
     * Sets the filter items.
     *
     * @param \AlbertMage\Catalog\Api\Data\FilterItemInterface[] $items
     * @return $this
     */
    public function setItems($items);
    
}
