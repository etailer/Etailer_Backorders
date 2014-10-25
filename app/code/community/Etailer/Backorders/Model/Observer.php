<?php

class Etailer_Backorders_Model_Observer
{

    public function catalogProductIsSalableAfter($observer)
    {
        $salable = $observer->getSalable();
        $product = $observer->getProduct();

        switch ($product->getTypeId()) {
            case Mage_Catalog_Model_Product_Type::TYPE_CONFIGURABLE:
            case Mage_Catalog_Model_Product_Type::TYPE_GROUPED:
            case Mage_Catalog_Model_Product_Type::TYPE_BUNDLE:
                break;
            default:
                $stock = Mage::getModel('cataloginventory/stock_item')
                    ->loadByProduct($product);

                $_qty = (int)$stock->getQty();
                $_minQty = (int)$stock->getMinQty();

                if ($_qty <= $_minQty) {
                    $salable->setIsSalable(false);
                }
        }
    }

}
