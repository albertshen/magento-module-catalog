<?php
/**
 *
 * Copyright © PHP Digital, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AlbertMage\Catalog\Model\Category;

/**
 * Interface CategoryInterface
 * @api
 * @since 101.0.0
 */
class DefaultProvider implements \AlbertMage\Catalog\Model\CategoryInterface
{

    public function normalizeCategories($categories)
    {
        $data = [];

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $link = $objectManager->get('\AlbertMage\PageBuilder\Model\UrlInterface');

        foreach ($categories as $category) {
            if ($category->getLevel() > 1) {
                $item = [];
                $item['id'] = $category->getId();
                $item['name'] = $category->getName();
                $item['url'] = $link->generate($category->getId(), 'category');
                if ($category->hasChildren()) {
                    $item['children'] = $this->normalizeCategories($category->getChildrenCategories());
                }
                $data[] = $item;
            }
        }
        return $data;
    }
    
}
