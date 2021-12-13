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

    /**
     * @inheritdoc
     */
    public function getList()
    {

//         $layerResolver = ObjectManager::getInstance()->get(\Magento\Catalog\Model\Layer\Resolver::class);
//         $filterList = ObjectManager::getInstance()->create(\categoryFilterList::class);

//         $layer = $layerResolver->get();
//         $layer->setCurrentCategory(21);
//         var_dump(get_class_methods($layer));exit;
//         $filters = $filterList->getFilters($layer);
//         $maxPrice = $layer->getProductCollection()->getMaxPrice();
//         $minPrice = $layer->getProductCollection()->getMinPrice(); 

//         $i = 0;
//        foreach($filters as $filter)
//        {    //var_dump(get_class_methods($filter));exit;
//            $availablefilter = $filter->getRequestVar(); //Gives the request param name such as 'cat' for Category, 'price' for Price
//            var_dump($availablefilter);
//            $availablefilter = (string)$filter->getName(); //Gives Display Name of the filter such as Category,Price etc.
//            $items = $filter->getItems(); //Gives all available filter options in that particular filter
//            $filterValues = array();
//            $j = 0;

//            foreach($items as $item)
//            {


//                $filterValues[$j]['display'] = strip_tags($item->getLabel());
//                $filterValues[$j]['value']   = $item->getValue();
//                $filterValues[$j]['count']   = $item->getCount(); //Gives no. of products in each filter options
//                $j++;
//            }
//            if(!empty($filterValues) && count($filterValues)>1)
//            {
//                $filterArray['availablefilter'][$availablefilter] =  $filterValues;
//            }
//            $i++;
//        } 

// var_dump($filterArray);exit;
//         exit;

        $filters = [
            //'search_term' => 'shoulder',
            //'category_ids' => 2,
            //'features_bags' => 73
        ];
        // $filters = [
        //     'category_ids' => 2
        // ];
        $searchLayer = ObjectManager::getInstance()->create(\Magento\Catalog\Model\Layer\Category::class);
        //$searchLayer = ObjectManager::getInstance()->get(\Magento\Catalog\Model\Layer\Resolver::class)->get();
        $searchLayer->setCurrentCategory(21);
        $fulltextCollection = $searchLayer->getProductCollection();

        foreach ($filters as $field => $value) {
            $fulltextCollection->addFieldToFilter($field, $value);
        }

        $fulltextCollection->addFieldToFilter('cat', [23, 26]);
        //$fulltextCollection->addFieldToFilter('price', '50-60');
        //$fulltextCollection->addFieldToFilter('price', ['from' => 30.00 , 'to' => 40.00]);
        //$fulltextCollection->addFieldToFilter('climate', 201);
        //$fulltextCollection->addFieldToFilter('style_general', 116);
        //$fulltextCollection->addFieldToFilter('style_general', [116, 141]);
        //$fulltextCollection->addSearchFilter('Riona');

        // if (isset($filters['search_term'])) {
        //     $fulltextCollection->addSearchFilter($filters['search_term']);
        // }
        $fulltextCollection->setOrder('price', 'DESC');
        $fulltextCollection->setPageSize(6);
        $fulltextCollection->loadWithFilter();
        //$curr = $fulltextCollection->getCurPage();//var_dump($curr);exit;
        var_dump($fulltextCollection->getSize());
        //var_dump(get_class_methods($fulltextCollection));exit;
        //var_dump(get_class_methods($fulltextCollection));exit;
        $items = $fulltextCollection->getItems();
        // var_dump($fulltextCollection->getFacetedData('price'));
        foreach ($items as $item) {
            //var_dump(get_class_methods($item));exit;

            var_dump($item->getSku());
        }

        $filterList = ObjectManager::getInstance()->create(\categoryFilterList::class);
        $filters = $filterList->getFilters($searchLayer);
        $i = 0;
        var_dump(count($filters));
       foreach($filters as $filter)
       {    //var_dump(get_class_methods($filter));exit;
           //$availablefilter = $filter->getRequestVar(); //Gives the request param name such as 'cat' for Category, 'price' for Price
           //var_dump($availablefilter);
           //echo($filter->getName());exit;
           $availablefilter = (string)$filter->getName(); //Gives Display Name of the filter such as Category,Price etc.
           $items = $filter->getItems(); //Gives all available filter options in that particular filter
           //var_dump(count($items));exit;
           $filterValues = array();
           $j = 0;
           foreach($items as $item)
           {


               $filterValues[$j]['display'] = strip_tags($item->getLabel());
               $filterValues[$j]['value']   = $item->getValue();
               $filterValues[$j]['count']   = $item->getCount(); //Gives no. of products in each filter options
               $j++;
           }
           if(!empty($filterValues) && count($filterValues)>1)
           {
               $filterArray['availablefilter'][$availablefilter] =  $filterValues;
           }
           $i++;
       } 
var_dump($filterArray);exit;
        exit;
        // $searchCriteria = ObjectManager::getInstance()->get(\Magento\Framework\Api\Search\SearchCriteria::class)->create();

        // $search = ObjectManager::getInstance()->get(\Magento\Framework\Search\Search::class)->create();
        // $search->search($searchCriteria);

        // exit;
       //  $request = ObjectManager::getInstance()->get(\Magento\Framework\Search\Request\Builder::class)->create();
       //  var_dump($request);exit;
       // $es = ObjectManager::getInstance()->get(\Magento\AdvancedSearch\Model\Client\ClientResolver::class)->create();
       // //$es->query($request);
       // $a = $es->query(json_decode('{"index":"magento2_product_2","type":"document","body":{"from":0,"size":12,"stored_fields":["_id","_score"],"sort":[{"_score":{"order":"desc"}}],"query":{"bool":{"must":[{"terms":{"visibility":["3","4"]}}],"should":[{"match":{"_search":{"query":"wool","boost":2}}},{"match":{"name":{"query":"wool","boost":6}}},{"match":{"sku":{"query":"wool","boost":7}}},{"match":{"description":{"query":"wool","boost":2}}},{"match":{"short_description":{"query":"wool","boost":2}}},{"match":{"manufacturer_value":{"query":"wool","boost":2}}},{"match":{"status_value":{"query":"wool","boost":2}}},{"match":{"url_key":{"query":"wool","boost":2}}},{"match":{"tax_class_id_value":{"query":"wool","boost":2}}},{"match":{"_search":{"query":"wool","boost":2}}},{"match_phrase_prefix":{"name":{"query":"wool","boost":2,"analyzer":"prefix_search"}}},{"match_phrase_prefix":{"sku":{"query":"wool","boost":2,"analyzer":"sku_prefix_search"}}}],"minimum_should_match":1}},"aggregations":{"price_bucket":{"extended_stats":{"field":"price_0_1"}},"category_bucket":{"terms":{"field":"category_ids","size":500}}}},"track_total_hits":true}', true));
       // var_dump($a);exit;
       // foreach($a as $item) {
       //  var_dump($item);
       // }

       $collection = ObjectManager::getInstance()->get(elasticsearchFulltextSearchCollection::class);
       $collection->addSearchFilter('bag');
       //$collection->addFieldToFilter('category_ids', 4);
       $collection->addAttributeToSort('relevance', 'DESC');

       //$collection->test();
       foreach($collection as $item) {
        var_dump(3);
       }
       exit;
    }

    // public function getList()
    // {

    //     $data = [];

    //     $page = $this->_request->getParam('page') ?? 1;
    //     $pageSize = $this->_request->getParam('pageSize') ?? 10;
    //     $catId = $this->_request->getParam('catId');

    //     if (!$catId) {
    //         return [];
    //     }

    //     $params = $this->_request->getParams();
    //     unset($params['page'], $params['pageSize'], $params['catId'], $params['sort']);
        
    //     $collection = $this->_productCollectionFactory->create();

    //     $collection->setPage($page, $pageSize);
    //     $collection->addAttributeToSelect('*');
    //     $collection->addCategoriesFilter(['in' => [$catId]]);

    //     if ($sort = $this->_request->getParam('sort')) {
    //         $sort = explode(',', $sort);
    //         $collection->addAttributeToSort($sort[0], $sort[1]);
    //     }
    //     //$collection->addAttributeToFilter('my_attribute_code', array('in' => array(12,10))); selectAttributes

    //     foreach ($params as $attribute => $value) { //and
    //         $arr = explode(',', $value);
    //         $arr = array_map(function($val) {
    //             return (int) $val;
    //         }, $arr);
    //         $collection->addAttributeToFilter([
    //             ['attribute' => $attribute, 'in' => $arr] //or
    //         ]);
    //     }

    //     $data['total'] = $collection->getSize();
    //     $data['pageSize'] = $collection->getPageSize();
    //     $data['currentPage'] = $collection->getCurPage();
    //     $productListProvider = ObjectManager::getInstance()->get(\AlbertMage\Catalog\Model\ProductList::class);
    //     $data['items'] = $productListProvider->getList($collection);
        
    //     return $data;
    // }
}
