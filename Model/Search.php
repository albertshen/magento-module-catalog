<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Model;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\DataObject;

/**
 * @author Albert Shen <albertshen1206@gmail.com>
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
     * @var \Magento\Catalog\Model\Layer\CategoryFactory
     */
    protected $categoryLayerFactory;

    /**
     * @var \Magento\Catalog\Model\Layer\SearchFactory
     */
    protected $searchLayerFactory;

    /**
     * @var \AlbertMage\Catalog\Api\Data\FilterInterfaceFactory
     */
    protected $filterInterfaceFactory;

    /**
     * @var \AlbertMage\Catalog\Api\Data\FilterItemInterfaceFactory
     */
    protected $filterItemInterfaceFactory;

    /**
     * @var \AlbertMage\Catalog\Api\Data\ProductSearchResultsInterfaceFactory
     */
    protected $productSearchResultsFactory;

    /**
     * @var \AlbertMage\Catalog\Api\ProductManagementInterface
     */
    protected $productManagement;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaFactory
     */
    protected $searchCriteriaFactory;

    /**
     * @var \Magento\Framework\Api\Search\FilterGroupFactory
     */
    protected $filterGroupFactory;

    /**
     * @var \Magento\Framework\Api\FilterFactory
     */
    protected $filterFactory;

    /**
     * @var \Magento\Framework\Api\SortOrderFactory
     */
    protected $sortOrderFactory;

    /**
     * @param \Magento\Framework\Webapi\Rest\Request $request
     * @param \Magento\Catalog\Model\Layer\CategoryFactory $categoryLayerFactory
     * @param \Magento\Catalog\Model\Layer\SearchFactory $searchLayerFactory
     * @param \AlbertMage\Catalog\Api\Data\FilterInterfaceFactory $filterInterfaceFactory
     * @param \AlbertMage\Catalog\Api\Data\FilterItemInterfaceFactory $filterItemInterfaceFactory,
     * @param \AlbertMage\Catalog\Api\Data\ProductSearchResultsInterfaceFactory $productSearchResultsFactory
     * @param \AlbertMage\Catalog\Api\ProductManagementInterface $productManagement
     * @param \Magento\Framework\Api\SearchCriteriaFactory $searchCriteriaFactory
     * @param \Magento\Framework\Api\Search\FilterGroupFactory $filterGroupFactory
     * @param \Magento\Framework\Api\FilterFactory $filterFactory
     * @param \Magento\Framework\Api\SortOrderFactory $sortOrderFactory
     */
    public function __construct(
        \Magento\Framework\Webapi\Rest\Request $request,
        \Magento\Catalog\Model\Layer\CategoryFactory $categoryLayerFactory,
        \Magento\Catalog\Model\Layer\SearchFactory $searchLayerFactory,
        \AlbertMage\Catalog\Api\Data\FilterInterfaceFactory $filterInterfaceFactory,
        \AlbertMage\Catalog\Api\Data\FilterItemInterfaceFactory $filterItemInterfaceFactory,
        \AlbertMage\Catalog\Api\Data\ProductSearchResultsInterfaceFactory $productSearchResultsFactory,
        \AlbertMage\Catalog\Api\ProductManagementInterface $productManagement,
        \Magento\Framework\Api\SearchCriteriaFactory $searchCriteriaFactory,
        \Magento\Framework\Api\Search\FilterGroupFactory $filterGroupFactory,
        \Magento\Framework\Api\FilterFactory $filterFactory,
        \Magento\Framework\Api\SortOrderFactory $sortOrderFactory
    )
    {
        $this->_request = $request;
        $this->categoryLayerFactory = $categoryLayerFactory;
        $this->searchLayerFactory = $searchLayerFactory;
        $this->filterInterfaceFactory = $filterInterfaceFactory;
        $this->filterItemInterfaceFactory = $filterItemInterfaceFactory;
        $this->productSearchResultsFactory = $productSearchResultsFactory;
        $this->productManagement = $productManagement;
        $this->searchCriteriaFactory = $searchCriteriaFactory;
        $this->filterGroupFactory = $filterGroupFactory;
        $this->filterFactory = $filterFactory;
        $this->sortOrderFactory = $sortOrderFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function search()
    {

        $page = $this->_request->getParam('page') ?? 1;
        $pageSize = $this->_request->getParam('pageSize') ?? 20;
        $catId = $this->_request->getParam('catId');

        $filterParams = $this->_request->getParams();
        unset($filterParams['page'], $filterParams['pageSize'], $filterParams['catId'], $filterParams['sort']);

        if ($catId) {
            $layer = $this->categoryLayerFactory->create();
            $layer->setCurrentCategory($catId);
            $filterList = ObjectManager::getInstance()->create(\categoryFilterList::class);
        } else {
            $layer = $this->searchLayerFactory->create();
            $filterList = ObjectManager::getInstance()->create(\searchFilterList::class);
        }

        $collection = $layer->getProductCollection();

        $productSearchResults = $this->productSearchResultsFactory->create();
        $searchCriteria = $this->searchCriteriaFactory->create();

        $filterGroups = [];
        foreach ($filterParams as $field => $value) { 
            // category_ids
            //and relation between different field. For instance: material=1&activity=2 (and)
            //or relation for field array value. For instance: activity=2,3 (or)
            $filters = [];
            if ($field === 'price') {
                $arr = explode('-', $value);
                $value = ['from' => (int) $arr[0] , 'to' => (int) $arr[1]];
                $collection->addFieldToFilter($field, $value);
                foreach($value as $k => $v) {
                    $filters[] = $this->createFilter($field.'.'.$k, $v);
                }
            } elseif ($field == 'q') {
                $filters[] = $this->createFilter($field, $value);
            } else {
                $arr = explode(',', $value);
                foreach($arr as $item) {
                    $collection->addFieldToFilter($field, $item);
                    $filters[] = $this->createFilter($field, $item);
                }
            }

            $filterGroup = $this->filterGroupFactory->create();
            $filterGroup->setFilters($filters);
            $filterGroups[] = $filterGroup;
            
        }

        $collection->setCurPage($page);
        $collection->setPageSize($pageSize);

        $sortOrders = [];
        if ($sort = $this->_request->getParam('sort')) {
            $sort = explode(',', $sort);
            $collection->setOrder($sort[0], $sort[1]);

            $sortOrder = $this->sortOrderFactory->create();
            $sortOrder->setField($sort[0]);
            $sortOrder->setDirection($sort[1]);
            $sortOrders[] = $sortOrder;
            $searchCriteria->setSortOrders($sortOrders);
        }


        $filters = $filterList->getFilters($layer);

        $filterList = $this->createFilterList($filters);

        $products = $collection->getItems();


        $searchCriteria->setFilterGroups($filterGroups);
        $searchCriteria->setPageSize($collection->getPageSize());
        $searchCriteria->setCurrentPage($collection->getCurPage());

        
        $newProducts = [];
        foreach($products as $product) {
            $newProducts[] = $this->getProductData($product);
        }

        $productSearchResults->setItems($newProducts);
        $productSearchResults->setSearchCriteria($searchCriteria);
        $productSearchResults->setTotalCount($collection->getSize());
        $productSearchResults->setFilterOptions($filterList);

        return $productSearchResults;
    }

    /**
     * Get product data
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return \AlbertMage\Catalog\Api\Data\ProductInterface
     */
    public function getProductData(\Magento\Catalog\Model\Product $product)
    {
        return $this->productManagement->createProduct($product);
    }

    /**
     * Returns filter list.
     *
     * @param \Filter\AbstractFilter[] $filters
     * @return \AlbertMage\Catalog\Api\Data\FilterInterface[].
     */
    private function createFilterList($filters)
    {

        $newFilters = [];
        
        foreach ($filters as $filter) {
            $newFilter = $this->filterInterfaceFactory->create();
            //Gives the request param name such as 'cat' for Category, 'price' for Price
            $newFilter->setField($filter->getRequestVar());
            $newFilter->setLabel($filter->getName());
            $items = $filter->getItems(); //Gives all available filter options in that particular filter
            $filterItems = [];
            foreach($items as $item)
            {
                $filterItem = $this->filterItemInterfaceFactory->create();
                $filterItem->setDisplay(strip_tags($item->getLabel()));
                $filterItem->setValue($item->getValue());
                $filterItem->setCount($item->getCount());
                $filterItems[] = $filterItem;
            }
            if(count($filterItems) > 0)
            {
                $newFilter->setItems($filterItems);
                $newFilters[] = $newFilter;
            }
        }

        return $newFilters;
    }

    /**
     * Create filter.
     *
     * @param \Filter\AbstractFilter[] $filters
     * @return \AlbertMage\Catalog\Api\Data\FilterInterface.
     */
    private function createFilter($field, $value)
    {
        $filter = $this->filterFactory->create();
        $filter->setField($field);
        $filter->setValue($value);
        return $filter;
    }
    

}
