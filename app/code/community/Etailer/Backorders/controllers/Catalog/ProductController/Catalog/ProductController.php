<?php

require_once 'Mage/Adminhtml/controllers/Catalog/ProductController.php';

class Etailer_Backorders_Catalog_ProductController_Catalog_ProductController
  extends Mage_Adminhtml_Catalog_ProductController
{
    /**
     * Filter product stock data
     *
     * @param array $stockData
     * @return null
     */
    protected function _filterStockData(&$stockData)
    {
        if (is_null($stockData)) {
            return;
        }
        if (!isset($stockData['use_config_manage_stock'])) {
            $stockData['use_config_manage_stock'] = 0;
        }
        if (isset($stockData['qty']) && (float)$stockData['qty'] > self::MAX_QTY_VALUE) {
            $stockData['qty'] = self::MAX_QTY_VALUE;
        }
        if (isset($stockData['min_qty']) && (int)$stockData['min_qty'] < 0) {
            $stockData['min_qty'] = (int)$stockData['min_qty'];
        }
        if (!isset($stockData['is_decimal_divided']) || $stockData['is_qty_decimal'] == 0) {
            $stockData['is_decimal_divided'] = 0;
        }
    }

}
