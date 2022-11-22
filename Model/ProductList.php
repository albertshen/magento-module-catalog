<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Model;

use Magento\Framework\DataObject;
use AlbertMage\Catalog\Api\ProductListInterface;

/**
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class ProductList implements ProductListInterface
{

    /**
     * @var \Magento\Framework\Webapi\Rest\Request
     */
    protected $_request;

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     */
    protected $_productCollectionFactory;

    /**
     * @param \Magento\Framework\Webapi\Rest\Request
     * @param \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory
     * @param array
     */
    public function __construct(
        \Magento\Framework\Webapi\Rest\Request $request,
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory
    )
    {
        $this->_productCollectionFactory = $productCollectionFactory;
        $this->_request = $request;
    }

    /**
     * @inheritdoc
     */
    public function getList()
    {

        $data = [];

        $page = $this->_request->getParam('page') ?? 1;
        $pageSize = $this->_request->getParam('pageSize') ?? 10;
        $catId = $this->_request->getParam('catId');

        if (!$catId) {
            return [];
        }

        $params = $this->_request->getParams();
        unset($params['page'], $params['pageSize'], $params['catId'], $params['sort']);
        
        $collection = $this->_productCollectionFactory->create();

        $collection->setPage($page, $pageSize);
        $collection->addAttributeToSelect('*');
        $collection->addCategoriesFilter(['in' => [$catId]]);

        if ($sort = $this->_request->getParam('sort')) {
            $sort = explode(',', $sort);
            $collection->addAttributeToSort($sort[0], $sort[1]);
        }
        //$collection->addAttributeToFilter('my_attribute_code', array('in' => array(12,10))); selectAttributes

        foreach ($params as $attribute => $value) { //and
            $arr = explode(',', $value);
            $arr = array_map(function($val) {
                return (int) $val;
            }, $arr);
            $collection->addAttributeToFilter([
                ['attribute' => $attribute, 'in' => $arr] //or
            ]);
        }

        $data['total'] = $collection->getSize();
        $data['pageSize'] = $collection->getPageSize();
        $data['currentPage'] = $collection->getCurPage();
        foreach($collection->getItems() as $product) {
            $data['items'][] = $this->getProductData($product)->getData();
        }
        
        return $data;
    }

    /**
     * Get product data
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return \Magento\Framework\DataObject
     */
    public function getProductData(\Magento\Catalog\Model\Product $product)
    {
        $dataObject = new DataObject([
            'sku' => $product->getSku(),
            'url' => $product->getProductUrl()
        ]);

        return $dataObject;
    }
}
