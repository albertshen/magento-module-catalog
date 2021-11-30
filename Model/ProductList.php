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
class ProductList implements ProductListInterface
{

    /**
     * @var \AlbertMage\Catalog\Api\ProductInterface
     */
    private $provider;

    /**
     * @param \Magento\Store\Model\StoreManagerInterface
     * @param array
     */
    public function __construct(
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        array $providers
    )
    {
        $storeCode = $storeManager->getStore()->getCode();

        if (isset($providers[$storeCode])) {
            $provider = ObjectManager::getInstance()->get($providers[$storeCode]);
            if (!$provider instanceof ProductListInterface) {
                throw new \InvalidArgumentException(
                    __('provider should be an instance of ProductInterface.')
                );
            }
            $this->provider = $provider;
        } else {
            $this->provider = ObjectManager::getInstance()->get($providers['default']);
        }

    }

    /**
     * @inheritdoc
     */
    public function getList($collection)
    {
        return $this->provider->getList($collection);
    }
}
