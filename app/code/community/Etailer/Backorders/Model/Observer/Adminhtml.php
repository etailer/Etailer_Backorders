<?php

class Etailer_Backorders_Model_Observer_Adminhtml
{

    public function addColumnsToGrid($observer)
    {
        $block = $observer->getBlock();

        if ($block instanceof Mage_Adminhtml_Block_Catalog_Product_Grid
            || $block instanceof Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Super_Config_Grid
            || ($block instanceof Mage_Adminhtml_Block_Widget_Grid && $block->getNameInLayout() === 'category.product.grid')
        ) {
            $block->addColumnAfter('min_qty',
                array(
                    'header'=> Mage::helper('catalog')->__('Backorderable'),
                    'type'  => 'number',
                    'index' => 'min_qty',
                    'width' => '50px'
            ), 'qty');
        }
    }

    public function joinFieldsToCollection($observer)
    {
        $collection = $observer->getCollection();
        $collection->joinField('min_qty',
                'cataloginventory/stock_item',
                'min_qty',
                'product_id=entity_id',
                '{{table}}.stock_id=1',
                'left');
    }

}
