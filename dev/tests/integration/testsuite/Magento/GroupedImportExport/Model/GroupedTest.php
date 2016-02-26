<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\GroupedImportExport\Model;

use Magento\CatalogImportExport\Model\AbstractProductExportImportTestCase;

class GroupedTest extends AbstractProductExportImportTestCase
{
    public function exportImportDataProvider()
    {
        return [
            'grouped-product' => [
                [
                    'Magento/GroupedProduct/_files/product_grouped.php'
                ],
                [
                    'grouped-product',
                ]
            ],
        ];
    }

    /**
     * @param \Magento\Catalog\Model\Product $expectedProduct
     * @param \Magento\Catalog\Model\Product $actualProduct
     */
    protected function assertEqualsSpecificAttributes($expectedProduct, $actualProduct)
    {
        $expectedAssociatedProducts = $expectedProduct->getTypeInstance()->getAssociatedProducts($expectedProduct);
        $actualAssociatedProducts = $actualProduct->getTypeInstance()->getAssociatedProducts($actualProduct);

        $expectedAssociatedProductSkus = [];
        $actualAssociatedProductSkus = [];
        $i = 0;
        foreach ($expectedAssociatedProducts as $associatedProduct) {
            $expectedAssociatedProductSkus[] = $associatedProduct->getSku();
            $actualAssociatedProductSkus[] = $actualAssociatedProducts[$i]->getSku();
            $i++;
        }

        $this->assertEquals($expectedAssociatedProductSkus, $actualAssociatedProductSkus);
    }
}
