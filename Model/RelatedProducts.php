<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Model;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Catalog\Model\ProductFactory;
use AlbertMage\Catalog\Api\ProductManagementInterface;

/**
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class RelatedProducts implements \AlbertMage\Catalog\Api\RelatedProductsInterface
{

    /**
     * @var CollectionFactory
     */
    protected $_productCollectionFactory;

    /**
     * @var ProductFactory
     */
    protected $productFactory;

    /**
     * @var ProductManagementInterface
     */
    protected $productManagement;

    /**
     * @param CollectionFactory
     * @param ProductFactory $productFactory
     * @param ProductManagementInterface $productManagement
     */
    public function __construct(
        CollectionFactory $productCollectionFactory,
        ProductFactory $productFactory,
        ProductManagementInterface $productManagement
    )
    {
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->productFactory = $productFactory;
        $this->productManagement = $productManagement;
    }

    /**
     * @inheritdoc
     */
    public function getRelatedProductsById($productId)
    {
        $product = $this->productFactory->create()->load($productId);
        if ($products = $this->getDesignatedRelatedProducts($product)) {
            return $products;
        }
        return $this->getAutoRelatedProducts($product);
    }

    /**
     * Get auto related products
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return \AlbertMage\Catalog\Api\Data\ProductInterface[]
     */
    public function getDesignatedRelatedProducts($product)
    {
        $relatedProductIds = $product->getRelatedProductIds();

        $collection = $this->_productCollectionFactory->create();
        $collection->addAttributeToSelect('*');
        $collection->addAttributeToFilter('entity_id', ['in' => $relatedProductIds]);

        // Prepare products
        $newProducts = [];
        foreach($collection->getItems() as $product) {
            $newProducts[] = $this->productManagement->getListItem($product); 
        }

        return $newProducts;
    }

    /**
     * Get auto related products
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return \AlbertMage\Catalog\Api\Data\ProductInterface[]
     */
    public function getAutoRelatedProducts($product)
    {

        $collection = $this->_productCollectionFactory->create();
        $collection->setPageSize(10);
        $collection->addAttributeToSelect('*');
        $collection->addCategoriesFilter(['in' => [$product->getCategoryIds()]]);
        $collection->addAttributeToSort('updated_at', 'desc');

        //$collection->setOrder('updated_at','DESC');
        //$collection->addAttributeToFilter('my_attribute_code', array('in' => array(12,10))); selectAttributes
        foreach($product->getAttributes() as $attribute) {
           if (in_array($attribute->getAttributeCode(), ['material', 'color'])) {
                $value = $product->getData($attribute->getAttributeCode());
                if ($value) {
                    $arr = explode(',', $value);
                    $arr = array_map(function($val) {
                        return (int) $val;
                    }, $arr);
                    $collection->addAttributeToFilter($attribute->getAttributeCode(), ['in' => $arr]); //or
                }
           }
        }

        $collection->addAttributeToFilter('entity_id', ['neq' => $product->getId()]);

        $newProducts = [];
        foreach($collection->getItems() as $product) {
            $newProducts[] = $this->productManagement->getListItem($product); 
        }

        return $newProducts;
    }

}
