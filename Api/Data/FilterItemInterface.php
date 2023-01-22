<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Api\Data;

/**
 * Interface FilterItem
 * @author Albert Shen <albertshen1206@gmail.com>
 */
interface FilterItemInterface
{

    const KEY_DISPLAY = 'display';

    const KEY_VALUE = 'value';

    const KEY_COUNT = 'count';

    const KEY_IS_SELECTED = 'is_selected';

    /**
     * Returns display.
     *
     * @return string.
     */
    public function getDisplay();

    /**
     * Sets the display.
     *
     * @param string $field
     * @return $this
     */
    public function setDisplay($display);

    /**
     * Returns value.
     *
     * @return string.
     */
    public function getValue();

    /**
     * Sets the value.
     *
     * @param string $value
     * @return $this
     */
    public function setValue($value);

    /**
     * Returns count.
     *
     * @return int.
     */
    public function getCount();

    /**
     * Sets the count.
     *
     * @param int $count
     * @return $this
     */
    public function setCount($count);

    /**
     * Returns is selected.
     *
     * @return bool|null
     */
    public function getIsSelected();

    /**
     * Sets the is selected.
     *
     * @param bool $isSelected
     * @return $this
     */
    public function setIsSelected($isSelected);
    
}
