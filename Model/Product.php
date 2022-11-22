<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Model;

use Magento\Framework\App\ObjectManager;

/**
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class Product implements \AlbertMage\Catalog\Api\ProductInterface
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
            if (!$provider instanceof \AlbertMage\Catalog\Api\ProductInterface) {
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
    public function getProduct()
    {
        return $this->provider->getProduct();
    }
}
