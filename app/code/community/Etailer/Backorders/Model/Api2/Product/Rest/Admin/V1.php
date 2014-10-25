<?php

class Etailer_Backorders_Model_Api2_Product_Rest_Admin_V1 extends Mage_Catalog_Model_Api2_Product_Rest_Admin_V1
{
    /**
     * Filter stock data values
     *
     * @param array $stockData
     */
    protected function _filterStockData(&$stockData)
    {
        $fieldsWithPossibleDefautlValuesInConfig = array('manage_stock', 'min_sale_qty', 'max_sale_qty', 'backorders',
            'qty_increments', 'notify_stock_qty', 'min_qty', 'enable_qty_increments');
        $this->_filterConfigValueUsed($stockData, $fieldsWithPossibleDefautlValuesInConfig);

        if ($this->_isManageStockEnabled($stockData)) {
            if (isset($stockData['qty']) && (float)$stockData['qty'] > self::MAX_DECIMAL_VALUE) {
                $stockData['qty'] = self::MAX_DECIMAL_VALUE;
            }
            if (isset($stockData['min_qty']) && (int)$stockData['min_qty'] < 0) {
                $stockData['min_qty'] = (int)$stockData['min_qty'];
            }
            if (!isset($stockData['is_decimal_divided']) || $stockData['is_qty_decimal'] == 0) {
                $stockData['is_decimal_divided'] = 0;
            }
        } else {
            $nonManageStockFields = array('manage_stock', 'use_config_manage_stock', 'min_sale_qty',
                'use_config_min_sale_qty', 'max_sale_qty', 'use_config_max_sale_qty');
            foreach ($stockData as $field => $value) {
                if (!in_array($field, $nonManageStockFields)) {
                    unset($stockData[$field]);
                }
            }
        }
    }

}
