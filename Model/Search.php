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
class Search implements \AlbertMage\Catalog\Api\SearchInterface
{

    const CATEGORY_FILTER = true;

    const SEARCH_FILTER = true;

    /**
     * @var \Magento\Framework\Webapi\Rest\Request
     */
    protected $_request;

    /**
     * @var \Magento\Catalog\Model\Layer
     */
    protected $layer;

    /**
     * @var \Magento\Catalog\Model\Layer\FilterList
     */
    protected $filterList;

    /**
     * @var \AlbertMage\Catalog\Model\ProductList
     */
    protected $productListProvider;

    /**
     * @param \Magento\Framework\Webapi\Rest\Request
     * @param array
     */
    public function __construct(
        \Magento\Framework\Webapi\Rest\Request $request,
        \AlbertMage\Catalog\Model\ProductList $productListProvider
    )
    {
        $this->_request = $request;
        $this->productListProvider = $productListProvider;
    }


    public function category()
    {
        $this->setLayer(ObjectManager::getInstance()->create(\Magento\Catalog\Model\Layer\Category::class));

        $data = $this->getProductList();
        if (self::CATEGORY_FILTER) {
            $this->setFilterList(ObjectManager::getInstance()->create(\categoryFilterList::class));
            $data['filter'] = $this->getFilterList();
        }
        return $data;
    }

    public function search()
    {
        $this->setLayer(ObjectManager::getInstance()->create(\Magento\Catalog\Model\Layer\Search::class));

        $data = $this->getProductList();
        if (self::SEARCH_FILTER) {
            $this->setFilterList(ObjectManager::getInstance()->create(\searchFilterList::class));
            $data['filter'] = $this->getFilterList();
        }
        return $data;
    }

    /**
     * @param \Magento\Catalog\Model\Layer
     */
    private function setLayer($layer)
    {
        $this->layer = $layer;
    }

    /**
     * @param \Magento\Catalog\Model\Layer\FilterList
     */
    private function setFilterList($filterList)
    {
        $this->filterList = $filterList;
    }

    private function getProductList()
    {

        $page = $this->_request->getParam('page') ?? 1;
        $pageSize = $this->_request->getParam('pageSize') ?? 20;
        $catId = $this->_request->getParam('catId');

        if ($catId) {
            $this->layer->setCurrentCategory($catId);
        }

        $collection = $this->layer->getProductCollection();

        $filters = $this->_request->getParams();
        unset($filters['q'], $filters['page'], $filters['pageSize'], $filters['catId'], $filters['sort']);

        foreach ($filters as $field => $value) { //and

            $arr = explode(',', $value);
            $value = array_map(function($val) {
                return (int) $val;
            }, $arr);

            if (count($value) == 1) {
                $value = $value[0];
            }

            if ($field === 'cat') {
                $field = 'category_ids';
            }

            if ($field === 'price') {
                $arr = explode('-', $value);
                $value = ['from' => (int) $arr[0] , 'to' => (int) $arr[1]];
            }

            $collection->addFieldToFilter($field, $value);
        }

        // if ($this->_request->getParam('q')) {
        //     $collection->addSearchFilter($this->_request->getParam('q'));
        // }
        // The query will be duplicated by Magento\CatalogSearch\Model\Layer\Search\Plugin\CollectionFilter afterFilter function

        
        $collection->setCurPage($page);
        $collection->setPageSize($pageSize);

        if ($sort = $this->_request->getParam('sort')) {
            $sort = explode(',', $sort);
            $collection->setOrder($sort[0], $sort[1]);
        }

        $data['total'] = $collection->getSize();
        $data['pageSize'] = $collection->getPageSize();
        $data['currentPage'] = $collection->getCurPage();
        $data['items'] = $this->productListProvider->getList($collection);
        return $data;
    }

    private function getFilterList()
    {
        $filters = $this->filterList->getFilters($this->layer);

        $filterArray = [];
        
        foreach ($filters as $filter) {
            //$availablefilter = $filter->getRequestVar(); //Gives the request param name such as 'cat' for Category, 'price' for Price
            $availablefilter = (string)$filter->getName(); //Gives Display Name of the filter such as Category,Price etc.
            $items = $filter->getItems(); //Gives all available filter options in that particular filter
            $filterValues = [];
            foreach($items as $item)
            {
                $filterValues[] = [
                    'display' => strip_tags($item->getLabel()),
                    'value' => $item->getValue(),
                    'count' => $item->getCount()

                ];
            }
            if(!empty($filterValues) && count($filterValues) > 0)
            {
                $filterArray[$availablefilter] =  $filterValues;
            }
        }
        return $filterArray;
    }

}
