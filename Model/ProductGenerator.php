<?php
/**
 * Copyright © PHP Digital, Inc. All rights reserved.
 */
namespace AlbertMage\Catalog\Model;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ProductFactory;
use Magento\Swatches\Helper\Data as SwatchHelper;
use Magento\Swatches\Helper\Media as SwatchMediaHelper;
use Magento\Framework\Api\DataObjectHelper;
use AlbertMage\Catalog\Model\Product\VisualSwatchFactory as ColorFactory;
use AlbertMage\Catalog\Model\Product\SizeFactory;
use AlbertMage\Catalog\Model\Product\MediaFactory;
use AlbertMage\Catalog\Model\Product\AttributeFactory as ProductAttributeFactory;
use AlbertMage\Catalog\Model\ConfigurableProduct\AttributeFactory as ConfigurableAttributeFactory;
use AlbertMage\Catalog\Model\ConfigurableProduct\OptionValueFactory;
use AlbertMage\Catalog\Model\ProductFactory as NewProductFactory;
use AlbertMage\Catalog\Api\Data\ProductListItemInterfaceFactory;
use AlbertMage\Catalog\Api\ProductManagementInterface;
use AlbertMage\PageBuilder\Model\DomFactory;
use Magento\InventorySalesApi\Api\GetProductSalableQtyInterface;
use Magento\ConfigurableProduct\Model\Product\Type\ConfigurableFactory;
use Magento\Catalog\Helper\Image as ImageHelper;

/**
 * ProductGenerator
 * 
 * @author Albert Shen <albertshen1206@gmail.com>
 */
class ProductGenerator implements \AlbertMage\Catalog\Api\ProductGeneratorInterface
{
    /**
     * @var Product
     */
    protected $product;

    /**
     * @var ProductFactory
     */
    protected $productFactory;

    /**
     * @var newProductFactory
     */
    protected $newProductFactory;

    /**
     * @var NewProduct
     */
    protected $newProduct;

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
     * @var ColorFactory
     */
    protected $colorFactory;

    /**
     * @var MediaFactory
     */
    protected $mediaFactory;

    /**
     * @var SwatchHelper
     */
    protected $swatchHelper;

    /**
     * @var SwatchMediaHelper
     */
    protected $swatchMediaHelper;

    /**
     * @var ImageHelper
     */
    protected $imageHelper;
    
    /**
     * @var GetProductSalableQtyInterface
     */
    protected $getProductSalableQty;

    /**
     * @var ConfigurableFactory
     */
    protected $configurableFactory;

    /**
     * @var string
     */
    protected $visualSwatchCode;

    /**
     * @var DomFactory
     */
    protected $domFactory;
    
    /**
     * @param ProductFactory $productFactory
     * @param NewProductFactory $newProductFactory
     * @param ConfigurableAttributeFactory $configurableAttributeFactory
     * @param ProductAttributeFactory $productAttributeFactory
     * @param OptionValueFactory $optionValueFactory
     * @param ColorFactory $colorFactory
     * @param MediaFactory $mediaFactory
     * @param SwatchHelper $swatchHelper
     * @param SwatchMediaHelper $swatchMediaHelper
     * @param ImageHelper $imageHelper
     * @param GetProductSalableQtyInterface $getProductSalableQty
     * @param ConfigurableFactory $configurableFactory
     * @param DomFactory $domFactory
     */
    public function __construct(
        ProductFactory $productFactory,
        NewProductFactory $newProductFactory,
        ConfigurableAttributeFactory $configurableAttributeFactory,
        ProductAttributeFactory $productAttributeFactory,
        OptionValueFactory $optionValueFactory,
        ColorFactory $colorFactory,
        MediaFactory $mediaFactory,
        SwatchHelper $swatchHelper,
        SwatchMediaHelper $swatchMediaHelper,
        ImageHelper $imageHelper,
        GetProductSalableQtyInterface $getProductSalableQty,
        ConfigurableFactory $configurableFactory,
        DomFactory $domFactory
    )
    {
        $this->productFactory = $productFactory;
        $this->newProductFactory = $newProductFactory;
        $this->newProduct = $newProductFactory->create();
        $this->configurableAttributeFactory = $configurableAttributeFactory;
        $this->productAttributeFactory = $productAttributeFactory;
        $this->optionValueFactory = $optionValueFactory;
        $this->colorFactory = $colorFactory;
        $this->mediaFactory = $mediaFactory;
        $this->swatchHelper = $swatchHelper;
        $this->swatchMediaHelper = $swatchMediaHelper;
        $this->imageHelper = $imageHelper;
        $this->getProductSalableQty = $getProductSalableQty;
        $this->configurableFactory = $configurableFactory;
        $this->domFactory = $domFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getDetail(\Magento\Catalog\Model\Product $product)
    {

        $this->setProduct($product);

        $this->setBaseData();

        //Set stock
        $this->setStock();

        $this->setPreOrderNote();

        $this->setShortDescription();
        
        $this->setDescription();

        $this->setTips();

        //Set Media Gallery
        $this->setMediaGallery();

        if ($product->getTypeId() == 'simple') {

            //Prepare product attributes
            $this->setProductAttributes();
        }
        
        if ($product->getTypeId() == 'configurable') {

            //Prepare attribute filter
            $this->setConfigurableAttributes();
        }

        if ($product->getTypeId() == 'bundle') {
            $this->newProduct->setBundleOptions($product->getTypeInstance()->getOptions($product));
        }

        //Prepare children products
        $this->setChildrenProducts();

        return $this->newProduct;
    }

    /**
     * {@inheritdoc}
     */
    public function getListItem(\Magento\Catalog\Model\Product $product)
    {

        $this->setProduct($product);

        $this->setBaseData();

        $this->setThumbnail();

        $this->setStock();

        if ($product->getTypeId() == 'simple') {

            //Prepare product attributes
            $this->setProductAttributes();
        }

        if ($parentIds = $this->configurableFactory->create()->getParentIdsByChild($product->getId())) {

            $parentProduct = $this->productFactory->create()->load($parentIds[0]);

            $this->setMainVisualSwatchCode($parentProduct);

            $defaultAttributeId = $product->getData($this->visualSwatchCode);

            $this->setListConfigurableProduct($parentProduct, $defaultAttributeId);

        }

        if ($product->getTypeId() == 'configurable') {

            $this->setMainVisualSwatchCode($product);

            $this->setListConfigurableProduct($product);

        }

        return $this->newProduct;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getCategoryListItem(\Magento\Catalog\Model\Product $product)
    {

        $this->setProduct($product);

        $this->setBaseData();

        $this->setThumbnail();

        if ($parentIds = $this->configurableFactory->create()->getParentIdsByChild($product->getId())) {

            $parentProduct = $this->productFactory->create()->load($parentIds[0]);

            $this->setMainVisualSwatchCode($parentProduct);

            $defaultAttributeId = $product->getData($this->visualSwatchCode);

            $this->setListConfigurableProduct($parentProduct, $defaultAttributeId);

        }


        if ($product->getTypeId() == 'configurable') {

            $this->setMainVisualSwatchCode($product);

            $this->setListConfigurableProduct($product);

        }

        return $this->newProduct;
    }

    /**
     * {@inheritdoc}
     */
    public function getSearchListItem(\Magento\Catalog\Model\Product $product)
    {

        $this->setProduct($product);

        $this->setBaseData();

        $this->setThumbnail();

        return $this->newProduct;
    }

    /**
     * {@inheritdoc}
     */
    public function getCartListItem(\Magento\Catalog\Model\Product $product)
    {
        $this->setProduct($product);

        $this->setBaseData();

        $this->setThumbnail();

        $this->setStock();

        return $this->newProduct;
    }

    /**
     * Get bundle item from system product
     *
     * @param \Magento\Catalog\Model\Product $product
     * @return \AlbertMage\Catalog\Api\Data\ProductInterface $product
     */
    private function getBundleItem(\Magento\Catalog\Model\Product $product)
    {

        $this->setProduct($product);

        $this->setBaseData();

        $this->setThumbnail();

        return $this->newProduct;
    }

    /**
     * Set system product
     * 
     * @param \Magento\Catalog\Model\Product $product
     * @return $this
     */
    private function setProduct(\Magento\Catalog\Model\Product $product) {
        $this->product = $product;
        return $this;
    }

    /**
     * Set main visual swatch code in list
     * 
     * @param \Magento\Catalog\Model\Product $product
     * @return void
     */
    private function setMainVisualSwatchCode(\Magento\Catalog\Model\Product $product)
    {
        foreach ($product->getTypeInstance()->getConfigurableAttributes($product) as $attribute) {
            $eavAttribute = $attribute->getProductAttribute();
            if ($this->swatchHelper->isVisualSwatch($eavAttribute)) {
                $this->visualSwatchCode = $eavAttribute->getAttributeCode();
            }
        }
    }

    /**
     * Set configurable product in list
     * 
     * @param \Magento\Catalog\Model\Product $product
     * @return void
     */
    private function setListConfigurableProduct(\Magento\Catalog\Model\Product $product, $defaultAttributeId = 0)
    {

        foreach ($product->getTypeInstance()->getConfigurableAttributes($product) as $attribute) {
            $eavAttribute = $attribute->getProductAttribute();
            if ($this->swatchHelper->isVisualSwatch($eavAttribute)) {
                $this->visualSwatchCode = $eavAttribute->getAttributeCode();
            }
        }

        $this->newProduct->setId($product->getId());
        $this->newProduct->setSku($product->getSku());
        $this->newProduct->setName($product->getName());
        $this->newProduct->setTypeId($product->getTypeId());

        //Set configurable children products in list
        $attributeIds = [];

        foreach ($product->getTypeInstance()->getConfigurableAttributesAsArray($product) as $attribute) {
            if ($attribute['attribute_code'] == $this->visualSwatchCode) {
                if ($defaultAttributeId > 0) {
                    $firstItem = 0;
                    foreach($attribute['values'] as $values) {
                        if ($values['value_index'] == $defaultAttributeId) {
                            $firstItem = $defaultAttributeId;
                        } else {
                            $attributeIds[] = $values['value_index'];
                        }
                    }
                    array_unshift($attributeIds, $firstItem);
                } else {
                    foreach($attribute['values'] as $values) {
                        $attributeIds[] = $values['value_index'];
                    }
                }
            }
        }
        
        $childrenProductIds = $product->getTypeInstance()->getUsedProductIds($product);
        $childrenProducts = [];
        foreach($attributeIds as $attributeId) {
            $qty = 0;
            $isDisabled = true;
            $isSetFirstProduct = false;
            $firstProduct =null;
            foreach ($childrenProductIds as $key => $productId) {
                $childrenProduct = $this->productFactory->create()->load($productId);
                if (!$childrenProduct->isDisabled()) {
                    $isDisabled = false;
                    if ($childrenProduct->getData($this->visualSwatchCode) == $attributeId) {

                        if (!$isSetFirstProduct) {
                            $firstProduct = $childrenProduct;
                            $isSetFirstProduct = true;
                        }
                        $qty = $qty + $this->getStock($childrenProduct);
                    }
                }
            }
            if (!$isDisabled) {
                $productGenerator = \Magento\Framework\App\ObjectManager::getInstance()->create(self::class);
                $childrenProduct = $productGenerator->getListConfigurableChild($firstProduct, $this->visualSwatchCode);
                $childrenProduct->setStock($qty);
                $childrenProducts[] = $childrenProduct;
            }
        }

        $this->newProduct->setChildrenProducts($childrenProducts);
    }

    /**
     * Get configurable child product in list
     * 
     * @param \Magento\Catalog\Model\Product $product
     * @return \AlbertMage\Catalog\Api\Data\ProductInterface
     */
    private function getListConfigurableChild(\Magento\Catalog\Model\Product $product, $visualSwatchCode)
    {
        $this->setProduct($product);

        $this->setBaseData();

        $this->setThumbnail();

        $this->newProduct->setPrice($product->getPrice());

        foreach($product->getAttributes() as $attribute) {
            $color = $this->colorFactory->create();
            if ($attribute->getAttributeCode() == $visualSwatchCode) {
                $color->setLabel($attribute->getDefaultFrontendLabel());
                $color->setCode($attribute->getAttributeCode());
                $color->setValue($product->getData($visualSwatchCode));
                $swatch = $this->getVisualSwatch(
                    $attribute->getDefaultFrontendLabel(),
                    $attribute->getAttributeCode(),
                    $product->getData($visualSwatchCode)
                );
                if ($swatch->getValue()) {
                    $color->setHashCode($swatch->getValue());
                }
                if ($swatch->getSwatchImage()) {
                    $color->setSwatchImage($swatch->getSwatchImage());
                }
                $this->newProduct->setColor($color);
            }
        }

        return $this->newProduct;
    }

    /**
     * Set base data
     * 
     * @return void
     */
    private function setBaseData() {
        $this->newProduct->setId($this->product->getId());
        $this->newProduct->setName($this->product->getName());
        $this->newProduct->setSku($this->product->getSku());
        $this->newProduct->setTypeId($this->product->getTypeId());
        $this->newProduct->setPrice($this->product->getPrice());

	    if ($specialPrice = $this->product->getSpecialPrice()) {
            $this->newProduct->setSpecialPrice($specialPrice);
        }

        //Set available
        $this->newProduct->setAvailable($this->product->isAvailable());

    }

    /**
     * Set Thumbnail
     * 
     * @return void
     */
    private function setThumbnail() {
        $url = $this->imageHelper->init($this->product, 'albertmage_product_list_thumbnail')->constrainOnly(FALSE)->keepAspectRatio(TRUE)->keepFrame(FALSE)->resize(500)->setImageFile($this->product->getThumbnail())->getUrl();
        $this->newProduct->setThumbnail($url);
    }

    private function setShortDescription() {
        $this->newProduct->setShortDescription($this->product->getShortDescription());
    }

    /**
     * Set description
     * 
     * @return void
     */
    private function setDescription() {
        $this->newProduct->setDescription($this->domFactory->create()->parse($this->product->getDescription()));
    }

    private function setTips() {

        if ($tips = $this->product->getTips()) {
            $this->newProduct->setTips($this->domFactory->create()->parse($tips));
        } else {
            $templateObject = \Magento\Framework\App\ObjectManager::getInstance()->create(\Magento\PageBuilder\Model\Template::class);
            $template = $templateObject->load(1);
            $this->newProduct->setTips($this->domFactory->create()->parse($template->getTemplate()));
        }

    }

    /**
     * Set preorder note
     * 
     * @return void
     */
    private function setPreOrderNote() {
        
    }

    /**
     * Set media gallery
     * 
     * @return void
     */
    private function setMediaGallery() {
        $mediaGallery = [];
        foreach($this->product->getMediaGalleryImages() as $item) {
            $media = $this->mediaFactory->create();
            $media->setMediaType($item->getMediaType());
            $media->setImageUrl($item->getUrl());
            if ($item->getMediaType() == 'upload-video') {
                $media->setVideoProvider($item->getVideoProvider());
                $media->setVideoUrl($this->product->getMediaConfig()->getMediaUrl($item->getVideoUrl()));
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
            $this->newProduct->setMediaGallery($mediaGallery);
        }
    }

    /**
     * Set stock
     * 
     * @return void
     */
    private function setStock() {
        if ($qty = $this->getStock($this->product)) {
            $this->newProduct->setStock($qty);
        }
    }

    /**
     * Get stock
     * 
     * @return int
     */
    private function getStock($product) {
        if (!$stockItem = $product->getExtensionAttributes()->getStockItem()) {
            $product = $product->load($product->getId());
        }

        if ($product->getExtensionAttributes()->getStockItem()->getQty()) {
            $stockId = $product->getExtensionAttributes()->getStockItem()->getStockId();
            $qty = $this->getProductSalableQty->execute($product->getSku(), $stockId);
            return $qty;
        }
        return 0;
    }

    /**
     * Set product attributes
     * 
     * @return void
     */
    private function setProductAttributes() {
        $productAttributes = [];
        foreach($this->product->getAttributes() as $attribute) {
            $productAttribute = $this->productAttributeFactory->create();
            //if ($attribute->getIndexType() == 'source') {
            if (in_array($attribute->getAttributeCode(), ['material', 'color'])) {
                $productAttribute->setLabel($attribute->getStoreLabel());
                $productAttribute->setCode($attribute->getAttributeCode());
                $value = $this->product->getAttributeText($attribute->getAttributeCode());
                if (is_string($value) || is_array($value)) {
                    if (is_string($value)) {
                        $value = [$value];
                    }
                    $productAttribute->setValue($value);
                    $productAttributes[] = $productAttribute;
                }
            }
        }
        if (!empty($productAttributes)) {
            $this->newProduct->setAttributes($productAttributes);
        }
    }

    /**
     * Set children products
     * 
     * @return void
     */
    private function setChildrenProducts() {
        //$usedProductIds = $this->product->getTypeInstance()->getUsedProductIds($this->product);
        $childrenProductIds = $this->product->getTypeInstance()->getChildrenIds($this->product->getId());
        if (!empty($childrenProductIds)) {

            $childrenProducts = [];

            foreach ($childrenProductIds as $key => $productIds) {

                foreach ($productIds as $productId) {

                    $childrenProduct = $this->productFactory->create()->load($productId);

                    if (!$childrenProduct->isDisabled()) {
                        $productGenerator = \Magento\Framework\App\ObjectManager::getInstance()->create(self::class);
                        if ($this->product->getTypeId() == 'bundle') {
                            $childrenProduct = $productGenerator->getBundleItem($childrenProduct)->setOptionId($key);
                        } else {
                            $childrenProduct = $productGenerator->getDetail($childrenProduct);
                        }
                        $childrenProducts[] = $childrenProduct;
                    }
                }

            }

            $this->newProduct->setChildrenProducts($childrenProducts);
        }

    }

    /**
     * Set configurable attributes
     * 
     * @return void
     */
    private function setConfigurableAttributes() {

        $configurableAttributes = [];
        foreach ($this->product->getTypeInstance()->getConfigurableAttributes($this->product) as $attribute) {
            $eavAttribute = $attribute->getProductAttribute();
            $storeId = 0;
            if ($this->product->getStoreId() !== null) {
                $storeId = $this->product->getStoreId();
            }
            $eavAttribute->setStoreId($storeId);

           $configurableAttribute = $this->configurableAttributeFactory->create();
           $configurableAttribute->setId($eavAttribute->getId());
           $configurableAttribute->setLabel($eavAttribute->getStoreLabel());
           $configurableAttribute->setCode($eavAttribute->getAttributeCode());
           $isVisualSwatch = $this->swatchHelper->isVisualSwatch($eavAttribute);
           $configurableAttribute->setIsVisualSwatch($isVisualSwatch);
           $optionValues = [];
           foreach($attribute->getOptions() as $optionItem) {
                $optionValue = $this->getVisualSwatch($optionItem['label'], $eavAttribute->getAttributeCode(), $optionItem['value_index'], $this->product);
                $optionValues[] = $optionValue;
           }
           $configurableAttribute->setValues($optionValues);
           $configurableAttributes[] = $configurableAttribute;
        }
        if (!empty($configurableAttributes)) {
            $this->newProduct->setConfigurableAttributes($configurableAttributes);
        }
    }


    /**
     * Get swatch Image
     * 
     * @param string $label
     * @param string $code
     * @param int $value_index
     * @param \Magento\Catalog\Model\Product $product
     * @return \AlbertMage\Catalog\Model\ConfigurableProduct\OptionValueInterface
     */
    private function getVisualSwatch(
        string $label,
        string $code,
        int $value_index,
        \Magento\Catalog\Model\Product $product = null
    ) {

        $swatches = $this->swatchHelper->getSwatchesByOptionsId([$value_index]);

        $swatch = $swatches[$value_index];

        $optionValue = $this->optionValueFactory->create();
        $optionValue->setValueIndex($value_index);
        $optionValue->setLabel($label);

        if ($swatch['type'] == '1') {
            $optionValue->setValue($swatch['value']);
        } else {
            if ($product) {
                $imageUrl = '';
                foreach ($product->getTypeInstance()->getUsedProducts($product) as $item) {
                    if ($value_index == $item->getData($code)) {
                         $imageUrl = $this->product->getMediaConfig()->getMediaUrl($item->getSwatchImage());
                         break;
                    }
                }
            } else {
                $imageUrl = $this->swatchMediaHelper->getSwatchAttributeImage('swatch_thumb', $swatch['value']);
            }
            $optionValue->setSwatchImage($imageUrl);
        }
        return $optionValue;

    }

}

