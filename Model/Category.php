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
class Category implements CategoryInterface
{

    /**
     * @var \AlbertMage\Catalog\Api\CategoryInterface
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
            if (!$provider instanceof \AlbertMage\Catalog\Model\CategoryInterface) {
                throw new \InvalidArgumentException(
                    __('provider should be an instance of CategoryInterface.')
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
    public function normalizeCategories($categories)
    {
        return $this->provider->normalizeCategories($categories);
    }
}
