<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Model;

use Magento\Catalog\Model\ProductFactory;
use Magento\Swatches\Helper\Data as SwatchHelper;
use AlbertMage\Catalog\Model\Product\ColorFactory;
use AlbertMage\Catalog\Model\Product\SizeFactory;
use AlbertMage\Catalog\Model\Product\MediaFactory;
use AlbertMage\Catalog\Model\Product\AttributeFactory as ProductAttributeFactory;
use AlbertMage\Catalog\Model\ConfigurableProduct\AttributeFactory as ConfigurableAttributeFactory;
use AlbertMage\Catalog\Model\ConfigurableProduct\OptionValueFactory;
use AlbertMage\Catalog\Model\ProductFactory as NewProductFactory;
use AlbertMage\Catalog\Api\Data\ProductListItemInterfaceFactory;
use AlbertMage\Catalog\Api\ProductManagementInterface;
use Magento\InventorySalesApi\Api\GetProductSalableQtyInterface;

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
     * @var ConfigurableAttributeFactory
     */
    protected $configurableAttributeFactory;

    /**
     * @var ProductAttributeFactory
     */
    protected $productAttributeFactory;

    /**
     * @var OptionValueFactory
     */
    protected $optionValueFactory;

    /**
     * @var MediaFactory
     */
    protected $mediaFactory;

    /**
     * @var SwatchHelper
     */
    protected $switchHelper;

    /**
     * @var ProductListItemInterfaceFactory
     */
    protected $productListItemInterfaceFactory;

    /**
     * @var GetProductSalableQtyInterface
     */
    protected $getProductSalableQty;

    /**
     * @var array
     */
    protected $showAttributes;

    /**
     * @var string
     */
    protected $swatchImageCode;

    /**
     * @param ProductFactory $productFactory
     * @param NewProductFactory $newProductFactory
     * @param ConfigurableAttributeFactory $configurableAttributeFactory
     * @param ProductAttributeFactory $productAttributeFactory
     * @param OptionValueFactory $optionValueFactory
     * @param MediaFactory $mediaFactory
     * @param SwatchHelper $switchHelper
     * @param ProductListItemInterfaceFactory $productListItemInterfaceFactory
     * @param GetProductSalableQtyInterface $getProductSalableQty
     * @param array $showAttributes
     * @param string $swatchImageCode
     */
    public function __construct(
        ProductFactory $productFactory,
        NewProductFactory $newProductFactory,
        ConfigurableAttributeFactory $configurableAttributeFactory,
        ProductAttributeFactory $productAttributeFactory,
        OptionValueFactory $optionValueFactory,
        MediaFactory $mediaFactory,
        SwatchHelper $switchHelper,
        ProductListItemInterfaceFactory $productListItemInterfaceFactory,
        GetProductSalableQtyInterface $getProductSalableQty,
        array $showAttributes,
        string $swatchImageCode
    )
    {
        $this->productFactory = $productFactory;
        $this->newProductFactory = $newProductFactory;
        $this->configurableAttributeFactory = $configurableAttributeFactory;
        $this->productAttributeFactory = $productAttributeFactory;
        $this->optionValueFactory = $optionValueFactory;
        $this->mediaFactory = $mediaFactory;
        $this->switchHelper = $switchHelper;
        $this->productListItemInterfaceFactory = $productListItemInterfaceFactory;
        $this->getProductSalableQty = $getProductSalableQty;
        $this->showAttributes = $showAttributes ?? ['color'];
        $this->swatchImageCode = $swatchImageCode ?? 'color';
    }

    /**
     * {@inheritdoc}
     */
    public function getProduct($productId)
    {
        $product = $this->productFactory->create()->load($productId);

        return $this->createProductDetail($product);
    }

    /**
     * Create product detail by product
     * 
     * @param \Magento\Catalog\Model\Product $product
     * @return \AlbertMage\Catalog\Api\Data\ProductInterface
     */
    private function createProductDetail(\Magento\Catalog\Model\Product $product)
    {

        $productDetail = $this->newProductFactory->create();

        $productDetail->setId($product->getId());
        $productDetail->setName($product->getName());
        $productDetail->setSku($product->getSku());
        //$productDetail->setPreOrderNote();
        $productDetail->setDescription($product->getDescription());

        //Set Media Gallery
        $this->setMediaGallery($productDetail, $product);

        //Set stock
        $this->setStock($productDetail, $product);

        $productDetail->setAvailable($product->isAvailable());

        if ($product->getTypeInstance() instanceof \Magento\Catalog\Model\Product\Type\Simple\Interceptor) {
            $productDetail->setPrice($product->getPrice());
            $productDetail->setSpecialPrice($product->getSpecialPrice());
            //Prepare product attributes
            $this->setProductAttributes($productDetail, $product);
        }

        if ($product->getTypeInstance() instanceof \Magento\ConfigurableProduct\Model\Product\Type\Configurable\Interceptor) {

            //Prepare attribute filter
            $this->setConfigurableAttributes($productDetail, $product);

            //Prepare sub products
            $this->setSubProducts($productDetail, $product);
        }

        return $productDetail;
    }

    /**
     * Set product attributes
     * 
     * @param \AlbertMage\Catalog\Model\Product $productDetail
     * @param \Magento\Catalog\Model\Product $product
     * @return void
     */
    private function setProductAttributes(
        \AlbertMage\Catalog\Model\Product $productDetail,
        \Magento\Catalog\Model\Product $product
    ) {
        $productAttributes = [];
        foreach($product->getAttributes() as $attribute) {
            $productAttribute = $this->productAttributeFactory->create();
            if (in_array($attribute->getAttributeCode(), $this->showAttributes)) {
                $productAttribute->setLabel($attribute->getDefaultFrontendLabel());
                $productAttribute->setCode($attribute->getAttributeCode());
                $productAttribute->setValue($product->getData($attribute->getAttributeCode()));
                $productAttributes[] = $productAttribute;
            }
        }
        $productDetail->setAttributes($productAttributes);
    }

    /**
     * Set configurable attributes
     * 
     * @param \AlbertMage\Catalog\Model\Product $productDetail
     * @param \Magento\Catalog\Model\Product $product
     * @return void
     */
    private function setConfigurableAttributes(
        \AlbertMage\Catalog\Model\Product $productDetail,
        \Magento\Catalog\Model\Product $product
    ) {
        $productAttributeOptions = $product->getTypeInstance()->getConfigurableAttributesAsArray($product);
        $configurableAttributes = [];
        foreach($productAttributeOptions as $key => $item) {
           $configurableAttribute = $this->configurableAttributeFactory->create();
           $configurableAttribute->setId($item['attribute_id']);
           $configurableAttribute->setLabel($item['label']);
           $configurableAttribute->setCode($item['attribute_code']);
           $optionValues = [];
           foreach($item['values'] as $optionItem) {
                $optionValue = $this->optionValueFactory->create();
                $optionValue->setValueIndex($optionItem['value_index']);
                $optionValue->setLabel($optionItem['label']);
                if ($imageUrl = $this->getSwatchImage($item['attribute_code'], $optionItem['value_index'], $product)) {
                    $optionValue->setSwatchImage($imageUrl);
                }
                $optionValues[] = $optionValue;
           }
           $configurableAttribute->setValues($optionValues);
           $configurableAttributes[] = $configurableAttribute;
        }
        $productDetail->setConfigurableAttributes($configurableAttributes);
    }

    /**
     * Set media gallery
     * 
     * @param \AlbertMage\Catalog\Model\Product $productDetail
     * @param \Magento\Catalog\Model\Product $product
     * @return void
     */
    private function setMediaGallery(
        \AlbertMage\Catalog\Model\Product $productDetail,
        \Magento\Catalog\Model\Product $product
    ) {
        $mediaGallery = [];
        foreach($product->getMediaGalleryImages() as $item) {
            $media = $this->mediaFactory->create();
            $media->setMediaType($item->getMediaType());
            $media->setImageUrl($item->getUrl());
            if ($item->getMediaType() == 'upload-video') {
                $media->setVideoProvider($item->getVideoProvider());
                $media->setVideoUrl($product->getMediaConfig()->getMediaUrl($item->getVideoUrl()));
                if ($item->getVideoTitle()) {
                    $media->setVideoTitle($item->getVideoTitle());
                }
                if ($item->getVideoDescription()) {
                    $media->setVideoDescription($item->getVideoDescription());
                }
            }
            $mediaGallery[] = $media;
        }
        if (!empty($mediaGallery)) {
            $productDetail->setMediaGallery($mediaGallery);
        }
    }

    /**
     * Get media gallery
     * 
     * @param string $code
     * @param string $attributeId
     * @param \Magento\Catalog\Model\Product $product
     * @return string|null
     */
    private function getSwatchImage(
        string $code,
        string $attributeId,
        \Magento\Catalog\Model\Product $product
    ) {
        if ($code == $this->swatchImageCode) {
            foreach ($product->getTypeInstance()->getUsedProducts($product) as $item) {
                if ($attributeId == $item->getData($code)) {
                    return $item->getMediaGalleryImages()->getFirstItem()->getUrl();
                }
            }
        }
        return null;
    }

    /**
     * Set stock
     * 
     * @param \AlbertMage\Catalog\Model\Product $productDetail
     * @param \Magento\Catalog\Model\Product $product
     * @return void
     */
    private function setStock(
        \AlbertMage\Catalog\Model\Product $productDetail,
        \Magento\Catalog\Model\Product $product
    ) {
        if ($product->getExtensionAttributes()->getStockItem()->getQty()) {
            $stockId = $product->getExtensionAttributes()->getStockItem()->getStockId();
            $qty = $this->getProductSalableQty->execute($product->getSku(), $stockId);
            $productDetail->setStock($qty);
        }
    }

    /**
     * Set sub products
     * 
     * @param \AlbertMage\Catalog\Model\Product $productDetail
     * @param \Magento\Catalog\Model\Product $product
     * @return void
     */
    private function setSubProducts(
        \AlbertMage\Catalog\Model\Product $productDetail,
        \Magento\Catalog\Model\Product $product
    ) {
        $usedProductIds = $product->getTypeInstance()->getUsedProductIds($product);
        $subProducts = [];
        foreach ($usedProductIds as $usedProductId) {
            $usedProduct = $this->productFactory->create()->load($usedProductId);
            $subProducts[] = $this->createProductDetail($usedProduct);
        }
        $productDetail->setSubProducts($subProducts);
    }

    /**
     * Create product by id
     * 
     * @param int $productId
     * @return \AlbertMage\Catalog\Api\Data\ProductListItemInterface
     */
    public function createProductListItemById($productId)
    {
        $product = $this->productFactory->create()->load($productId);
        return $this->createProductListItem($product);
    }

    /**
     * Create product
     * 
     * @param \Magento\Catalog\Model\Product
     * @return \AlbertMage\Catalog\Api\Data\ProductListItemInterface
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
