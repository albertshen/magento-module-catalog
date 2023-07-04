<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Model;

use AlbertMage\Catalog\Api\Data\ProductInterface;
use AlbertMage\Catalog\Api\ProductGeneratorInterfaceFactory;
use AlbertMage\Catalog\Api\ProductCacheInterface;
use AlbertMage\Core\Model\Cache\RedisAdapter as Cache;
use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\Webapi\ServiceOutputProcessor;
use Magento\Framework\Webapi\ServiceInputProcessor;

/**
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class ProductManagement implements ProductCacheInterface
{

    /**
     * @var ProductGeneratorInterfaceFactory
     */
    protected $productGeneratorInterfaceFactory;

    /**
     * @var Cache
     */
    protected $cache;

    /**
     * @var ProductFactory
     */
    protected $productFactory;

    /**
     * @var ServiceOutputProcessor
     */
    protected $serviceOutputProcessor;

    /**
     * @var ServiceInputProcessor
     */
    protected $serviceInputProcessor;

    /**
     * @param ProductGeneratorInterfaceFactory $productGeneratorInterfaceFactory
     * @param Cache $cache
     * @param ProductFactory $productFactory
     * @param ServiceOutputProcessor $serviceOutputProcessor
     * @param ServiceInputProcessor $serviceInputProcessor
     */
    public function __construct(
        ProductGeneratorInterfaceFactory $productGeneratorInterfaceFactory,
        Cache $cache,
        ProductFactory $productFactory,
        ServiceOutputProcessor $serviceOutputProcessor,
        ServiceInputProcessor $serviceInputProcessor
    )
    {
        $this->productGeneratorInterfaceFactory = $productGeneratorInterfaceFactory;
        $this->cache = $cache;
        $this->serviceOutputProcessor = $serviceOutputProcessor;
        $this->serviceInputProcessor = $serviceInputProcessor;
        $this->productFactory = $productFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getDetail($productId)
    {
        $data = $this->cache->get($this->getDetailCacheKey($productId), function ($item) use ($productId) {
            $product = $this->productGeneratorInterfaceFactory->create()->getDetail(
                $this->productFactory->create()->load($productId)
            );
            $item->expiresAfter(self::CACHE_EXPIRE_TIME);
            return $this->serviceOutputProcessor->convertValue($product, ProductInterface::class);
        });
        return $this->serviceInputProcessor->convertValue($data, ProductInterface::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getListItem(\Magento\Catalog\Model\Product $product)
    {
        $data = $this->cache->get($this->getListItemCacheKey($product->getId()), function ($item) use ($product) {
            $product = $this->productGeneratorInterfaceFactory->create()->getListItem(
                $product
            );
            $item->expiresAfter(self::CACHE_EXPIRE_TIME);
            return $this->serviceOutputProcessor->convertValue($product, ProductInterface::class);
        });
        return $this->serviceInputProcessor->convertValue($data, ProductInterface::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getListItemById($productId)
    {
        $data = $this->cache->get($this->getListItemCacheKey($productId), function ($item) use ($productId) {
            $product = $this->productGeneratorInterfaceFactory->create()->getListItem(
                $this->productFactory->create()->load($productId)
            );
            $item->expiresAfter(self::CACHE_EXPIRE_TIME);
            return $this->serviceOutputProcessor->convertValue($product, ProductInterface::class);
        });
        return $this->serviceInputProcessor->convertValue($data, ProductInterface::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getCategoryListItem(\Magento\Catalog\Model\Product $product)
    {
        $data = $this->cache->get($this->getCategoryListItemCacheKey($product->getId()), function ($item) use ($product) {
            $product = $this->productGeneratorInterfaceFactory->create()->getCategoryListItem($product);
            $item->expiresAfter(self::CACHE_EXPIRE_TIME);
            return $this->serviceOutputProcessor->convertValue($product, ProductInterface::class);
        });
        return $this->serviceInputProcessor->convertValue($data, ProductInterface::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getSearchListItem(\Magento\Catalog\Model\Product $product)
    {
        $data = $this->cache->get($this->getSearchListItemCacheKey($product->getId()), function ($item) use ($product) {
            $product = $this->productGeneratorInterfaceFactory->create()->getSearchListItem($product);
            $item->expiresAfter(self::CACHE_EXPIRE_TIME);
            return $this->serviceOutputProcessor->convertValue($product, ProductInterface::class);
        });
        return $this->serviceInputProcessor->convertValue($data, ProductInterface::class);
    }

    /**
     * {@inheritdoc}
     */
    public function cleanDetailCache($productId)
    {
        $this->cache->clear($this->getCategoryListItemCacheKey($productId));
    }

    /**
     * {@inheritdoc}
     */
    public function cleanListItemCache($productId)
    {
        $this->cache->clear($this->getListItemCacheKey($productId));
    }

    /**
     * {@inheritdoc}
     */
    public function cleanProductCache($productId)
    {
        $this->cleanDetailCache($productId);
        $this->cleanListItemCache($productId);
    }

    /**
     * {@inheritdoc}
     */
    public function cleanAllProductCache()
    {
        $this->cache->clear(self::CACHE_PREFIX_PRODUCT);
    }

    /**
     * {@inheritdoc}
     */
    public function refreshDetailCache($productId)
    {
        $this->cache->clear($this->getCategoryListItemCacheKey($productId));
        $this->getDetail($this->productFactory->create()->load($productId));
    }

    /**
     * {@inheritdoc}
     */
    public function refreshListItemCache($productId)
    {
        $this->cache->clear($this->getListItemCacheKey($productId));
        $this->getListItem($this->productFactory->create()->load($productId));
    }

    /**
     * {@inheritdoc}
     */
    public function refreshCategoryListItemCache($productId)
    {
        $this->cache->clear($this->getCategoryListItemCacheKey($productId));
        $this->getCategoryListItem($this->productFactory->create()->load($productId));
    }

    /**
     * {@inheritdoc}
     */
    public function refreshSearchListItemCache($productId)
    {
        $this->cache->clear($this->getSearchListItemCacheKey($productId));
        $this->getSearchListItem($this->productFactory->create()->load($productId));
    }

    /**
     * {@inheritdoc}
     */
    public function refreshAllProductCache($productId)
    {
        $this->refreshDetailCache($productId);

        $this->refreshCategoryListItemCache($productId);
        
        $this->refreshSearchListItemCache($productId);

        $this->refreshListItemCache($productId);
    }

    /**
     * Get product detail cache key
     * 
     * @param int $productId
     * @return string
     */
    private function getDetailCacheKey(int $productId)
    {
        return self::CACHE_PREFIX_PRODUCT_DETAIL.'.'.$productId;
    }

    /**
     * Get product list item cache key
     * 
     * @param int $productId
     * @return string
     */
    private function getListItemCacheKey(int $productId)
    {
        return self::CACHE_PREFIX_PRODUCT_LIST.'.'.$productId;
    }

    /**
     * Get category product list item cache key
     * 
     * @param int $productId
     * @return string
     */
    private function getCategoryListItemCacheKey(int $productId)
    {
        return self::CACHE_PREFIX_PRODUCT_CATEGORY_LIST.'.'.$productId;
    }

    /**
     * Get search product list item cache key
     * 
     * @param int $productId
     * @return string
     */
    private function getSearchListItemCacheKey(int $productId)
    {
        return self::CACHE_PREFIX_PRODUCT_SEARCH_LIST.'.'.$productId;
    }

}
