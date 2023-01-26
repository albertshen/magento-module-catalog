<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Api\Data;

/**
 * Interface ProductAttribute
 * @author Albert Shen <albertshen1206@gmail.com>
 */
interface ProductAttributeInterface
{

    const LABEL = 'label';

    const VALUE = 'value';

    /**
     * Get color label
     *
     * @return string color label
     */
    public function getLabel();

    /**
     * Set color label
     *
     * @param string $label
     * @return $this
     */
    public function setLabel($label);

    /**
     * Get color value
     *
     * @return int color value
     */
    public function getValue();

    /**
     * Set color value
     *
     * @param int $value
     * @return $this
     */
    public function setValue($value);
    
}
