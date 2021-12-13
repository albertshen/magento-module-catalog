<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Catalog\Model\ProductList;

/**
 * Interface ProductListInterface
 * @api
 * @since 101.0.0
 */
class DefaultProvider implements \AlbertMage\Catalog\Model\ProductListInterface
{
    /**
     * @inheritdoc
     */
    public function getList(\Magento\Catalog\Model\ResourceModel\Product\Collection $collection)
    {
        $data = [];
        foreach($collection as $product) {

//             $data = $product->getTypeInstance()->getConfigurableOptions($product);

//             $options = [];

//             foreach($data as $attr){
//               foreach($attr as $p){
//                 var_dump($p);exit;
//                 $options[$p['sku']][$p['attribute_code']] = $p['option_title'];
//               }
//             }
// var_dump($options);exit;
            $data[] = [
                'name' => $product->getName()
            ];
        }
        return $data;
    }

}
