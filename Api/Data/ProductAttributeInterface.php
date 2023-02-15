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

    const CODE = 'code';

    const VALUE = 'value';

    /**
     * Get attribute label
     *
     * @return string attribute label
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
     * @return string attribute code
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
     * Get attribute value
     *
     * @return int attribute value
     */
    public function getValue();

    /**
     * Set attribute value
     *
     * @param int $value
     * @return $this
     */
    public function setValue($value);
    
}
