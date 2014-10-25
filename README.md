# Etailer_Backorders

Magento 1.7 CE introduced a check to ensure that a product's `min_qty` is `>= 0`, if the `min_qty` is negative it is set to `0` when the product is saved.

This is the admin product field titled: `Qty for Item's Status to Become Out of Stock`.

When accepting backorders it can be useful to limit the quantity available, the extension overrides the checks in Magento core files to allow for negative `min_qty` values.

Also included is an overrride for the same check in the `REST` API, this is untested.
Please send feedback via a GH issue if this doesn't perform as expected.

### Features

* Allows negative values for `min_qty`.
* Makes catalog products not saleable if `qty` exceeds `min_qty`.
* Uses `min_qty` as the limit for backorders.

## Note

Please test this extensively before using in production as I have not checked a full range of use cases.


## References

* [http://www.magentocommerce.com/boards/viewthread/288259/](http://www.magentocommerce.com/boards/viewthread/288259/)
* [http://magento.stackexchange.com/questions/4201/limit-product-backorder-qty](http://magento.stackexchange.com/questions/4201/limit-product-backorder-qty)
* [http://magento.stackexchange.com/questions/41300/limit-backorder-qty-of-the-product](http://magento.stackexchange.com/questions/41300/limit-backorder-qty-of-the-product)
