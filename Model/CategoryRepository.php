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
class CategoryRepository implements \AlbertMage\Catalog\Api\CategoryRepositoryInterface
{

    protected $_categoryCollectionFactory;

    protected $_categoryHelper;

    /**
     * @var \Magento\Catalog\Model\CategoryRepository
     */
    protected $_categoryRepository;

    /**
     * @param \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory
     * @param \Magento\Catalog\Helper\Category
     * @param array
     */
    public function __construct(
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
        \Magento\Catalog\Helper\Category $categoryHelper,
        \Magento\Catalog\Model\CategoryRepository $categoryRepository
    )
    {
        $this->_categoryCollectionFactory = $categoryCollectionFactory;
        $this->_categoryHelper = $categoryHelper;
        $this->_categoryRepository = $categoryRepository;
    }

    /**
     * @inheritdoc
     */
    public function getCategoryTree()
    {
        $categories = $this->getCategoryCollection(true, 2, 'position');
        $categoryProvider = ObjectManager::getInstance()->get(\AlbertMage\Catalog\Model\Category::class);
        return $categoryProvider->normalizeCategories($categories);
    }

    /**
     * @inheritdoc
     */
    public function getCategoryTreeById($catId)
    {

        $category = $this->_categoryRepository->get($catId);
        if ($category->hasChildren()) {
            $categoryProvider = ObjectManager::getInstance()->get(\AlbertMage\Catalog\Model\Category::class);
            return $categoryProvider->normalizeCategories($category->getChildrenCategories());
        }
    }

    /**
     * Retrieve current store categories
     *
     * @param bool $isActive
     * @param bool $level
     * @param bool|string $sortBy
     * @param bool|string $pageSize
     * @return \Magento\Catalog\Model\ResourceModel\Category\Collection
     */
    private function getCategoryCollection($isActive = true, $level = false, $sortBy = false, $pageSize = false)
    {
        $collection = $this->_categoryCollectionFactory->create();
        $collection->addAttributeToSelect('*');

        // select only active categories
        if ($isActive) {
            $collection->addIsActiveFilter();
        }

        // select categories of certain level
        if ($level) {
            $collection->addLevelFilter($level);
        }

        // sort categories by some value
        if ($sortBy) {
            $collection->addOrderField($sortBy);
        }

        // set pagination
        if ($pageSize) {
            $collection->setPageSize($pageSize); 
        } 

        return $collection;
    }


     /**
     * Retrieve current store level 2 category
     *
     * @param bool|string $sorted (if true display collection sorted as name otherwise sorted as based on id asc)
     * @param bool $asCollection (if true display all category otherwise display second level category menu visible category for current store)
     * @param bool $toLoad
     */
    private function getStoreCategories($sorted = false, $asCollection = false, $toLoad = true)
    {
        return $this->_categoryHelper->getStoreCategories($sorted = false, $asCollection = false, $toLoad = true);
    }

}
