<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace AlbertMage\Catalog\Model;

use Magento\Framework\App\ObjectManager;

/**
 *
 */
class ProductRepository implements \AlbertMage\Catalog\Api\ProductRepositoryInterface
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
        $productListProvider = ObjectManager::getInstance()->get(\AlbertMage\Catalog\Model\ProductList::class);
        $data['items'] = $productListProvider->getList($collection);
        
        return $data;
    }
}
