<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Model;

use AlbertMage\Catalog\Api\Data\CategoryInterface;

/**
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class CategoryManagement implements \AlbertMage\Catalog\Api\CategoryManagementInterface
{

    /**
     * @var \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory
     */
    protected $categoryCollectionFactory;

    /**
     * @var \Magento\Catalog\Helper\Category
     */
    protected $categoryHelper;

    /**
     * @var \Magento\Catalog\Model\CategoryRepository
     */
    protected $categoryRepository;

    /**
     * @var \AlbertMage\Catalog\Api\Data\CategoryInterfaceFactory
     */
    protected $categoryInterfaceFactory;

    /**
     * @param \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory
     * @param \Magento\Catalog\Helper\Category
     * @param \Magento\Catalog\Model\CategoryRepository $categoryRepository
     * @param \AlbertMage\Catalog\Api\Data\CategoryInterfaceFactory $categoryInterfaceFactory
     */
    public function __construct(
        \Magento\Catalog\Model\ResourceModel\Category\CollectionFactory $categoryCollectionFactory,
        \Magento\Catalog\Helper\Category $categoryHelper,
        \Magento\Catalog\Model\CategoryRepository $categoryRepository,
        \AlbertMage\Catalog\Api\Data\CategoryInterfaceFactory $categoryInterfaceFactory
    )
    {
        $this->categoryCollectionFactory = $categoryCollectionFactory;
        $this->categoryHelper = $categoryHelper;
        $this->categoryRepository = $categoryRepository;
        $this->categoryInterfaceFactory = $categoryInterfaceFactory;
    }

    /**
     * @inheritdoc
     */
    public function getCategoryTree()
    {
        $categories = $this->getCategoryCollection(true, 2, 'position');
        return $this->generateCategoryTree($categories);
    }

    /**
     * @inheritdoc
     */
    public function getChildrenCategoriesById($catId)
    {
        $category = $this->categoryRepository->get($catId);
        if ($category->hasChildren()) {
            return $this->generateCategoryTree($category->getChildrenCategories());
        }
    }

    /**
     * Retrieve current store categories
     *
     * @param bool $isActive
     * @param int $level
     * @param string $sortBy
     * @param int $pageSize
     * @return \Magento\Catalog\Model\ResourceModel\Category\Collection
     */
    private function getCategoryCollection($isActive = true, $level = 1, $sortBy = '', $pageSize = 10)
    {
        $collection = $this->categoryCollectionFactory->create();
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
     * Retrieve category tree
     *
     * @param \Magento\Catalog\Model\ResourceModel\Category\Collection $categories
     * @return \AlbertMage\Catalog\Api\Data\CategoryInterface[]
     */
    private function generateCategoryTree(\Magento\Catalog\Model\ResourceModel\Category\Collection $categories)
    {
        $data = [];
        foreach ($categories as $category) {
            if ($category->getLevel() > 1) {
                $item = $this->getCategoryData($category);
                if ($category->hasChildren()) {
                    $item->setChildren($this->generateCategoryTree($category->getChildrenCategories()));
                }
                $data[] = $item;
            }
        }
        return $data;
    }

    /**
     * Get category data
     *
     * @param \Magento\Catalog\Model\Category $category
     * @return \AlbertMage\Catalog\Api\Data\CategoryInterface
     */
    public function getCategoryData(\Magento\Catalog\Model\Category $category)
    {
        $newCategory = $this->categoryInterfaceFactory->create();
        $newCategory->setId($category->getId());
        $newCategory->setName($category->getName());
        $newCategory->setUrl($category->getUrl());
        $newCategory->setThumbnail($category->getImageUrl());

        return $newCategory;
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
        return $this->categoryHelper->getStoreCategories($sorted = false, $asCollection = false, $toLoad = true);
    }
}
