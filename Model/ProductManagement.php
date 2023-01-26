<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Model;

use Magento\Catalog\Model\ProductFactory;
use Magento\Swatches\Helper\Data as SwatchHelper;
use AlbertMage\Catalog\Model\Product\ColorFactory;
use AlbertMage\Catalog\Model\Product\SizeFactory;
use AlbertMage\Catalog\Model\ConfigurableProduct\AttributeFactory;
use AlbertMage\Catalog\Model\ConfigurableProduct\OptionValueFactory;
use AlbertMage\Catalog\Model\ProductFactory as NewProductFactory;
use AlbertMage\Catalog\Api\Data\ProductListItemInterfaceFactory;
use AlbertMage\Catalog\Api\ProductManagementInterface;

/**
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class ProductManagement implements ProductManagementInterface
{

    /**
     * @var ProductFactory
     */
    protected $productFactory;

    /**
     * @var NewProductFactory
     */
    protected $newProductFactory;

    /**
     * @var AttributeFactory
     */
    protected $attributeFactory;

    /**
     * @var OptionValueFactory
     */
    protected $optionValueFactory;

    /**
     * @var SwatchHelper
     */
    protected $switchHelper;

    /**
     * @var ProductListItemInterfaceFactory
     */
    protected $productListItemInterfaceFactory;


    /**
     * @param ProductFactory $productFactory
     * @param NewProductFactory $newProductFactory
     * @param AttributeFactory $attributeFactory
     * @param OptionValueFactory $optionValueFactory
     * @param SwatchHelper $switchHelper
     * @param ProductListItemInterfaceFactory $productListItemInterfaceFactory
     */
    public function __construct(
        ProductFactory $productFactory,
        NewProductFactory $newProductFactory,
        AttributeFactory $attributeFactory,
        OptionValueFactory $optionValueFactory,
        SwatchHelper $switchHelper,
        ProductListItemInterfaceFactory $productListItemInterfaceFactory
    )
    {
        $this->productFactory = $productFactory;
        $this->newProductFactory = $newProductFactory;
        $this->attributeFactory = $attributeFactory;
        $this->optionValueFactory = $optionValueFactory;
        $this->switchHelper = $switchHelper;
        $this->productListItemInterfaceFactory = $productListItemInterfaceFactory;
    }

    // $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
    // $product = $objectManager->create(\Magento\Catalog\Model\Product::class)->load(1);
    // $attributesInfo = ['color' => 49];
    // $pp = $product->getTypeInstance()->getProductByAttributes($attributesInfo, $product);
    // $image = $pp->getMediaGalleryImages()->getFirstItem();
    // var_dump(4, $image->getPath());exit;

    // $product->getTypeInstance()->getUsedProducts();

    /**
     * {@inheritdoc}
     */
    public function getProduct($productId)
    {
        $product = $this->productFactory->create()->load($productId);
        $productAttributeOptions = $product->getTypeInstance()->getConfigurableAttributesAsArray($product);

        $newProduct = $this->newProductFactory->create();
        $attributes = [];
        foreach($productAttributeOptions as $key => $item) {
           $attribute = $this->attributeFactory->create();
           $attribute->setId($item['attribute_id']);
           $attribute->setLabel($item['label']);
           $attribute->setCode($item['attribute_code']);
           $optionValues = [];
           foreach($item['values'] as $optionItem) {
                $optionValue = $this->optionValueFactory->create();
                $optionValue->setValueIndex($optionItem['value_index']);
                $optionValue->setLabel($optionItem['label']);
                $optionValues[] = $optionValue;
                //$optionValue->setSwatchImage($optionItem['value_index']);
           }
           $attribute->setValues($optionValues);
           $attributes[] = $attribute;
        }

        $newProduct->setAttributes($attributes);
        return $newProduct;
    }

    /**
     * {@inheritdoc}
     */
    public function createProductListItemById($productId)
    {
        $product = $this->productFactory->create()->load($productId);
        return $this->createProductListItem($product);
    }

    /**
     * {@inheritdoc}
     */
    public function createProductListItem(\Magento\Catalog\Model\Product $product)
    {
        $newProduct = $this->productListItemInterfaceFactory->create();
        $newProduct->setId($product->getId());
        $newProduct->setName($product->getName());
        $newProduct->setThumbnail($product->getMediaConfig()->getBaseMediaUrl() . $product->getThumbnail());
        $newProduct->setPrice($product->getPrice());
        return $newProduct;
    }
}
