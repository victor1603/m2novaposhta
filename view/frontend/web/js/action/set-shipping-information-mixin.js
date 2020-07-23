define([
    'jquery',
    'mage/utils/wrapper',
    'Magento_Checkout/js/model/quote'
], function ($, wrapper, quote) {
    'use strict';
    return function (setShippingInformationAction) {

        return wrapper.wrap(setShippingInformationAction, function (originalAction) {
            var shippingAddress = quote.shippingAddress();

            if (shippingAddress['extension_attributes'] == undefined) {
                shippingAddress['extension_attributes'] = {};
            }

            if(quote.shippingMethod().method_code == 'novaposhta_shipping_warehouse') {
                alert($('[name="novaposhta_warehouse_ref"] option:selected').text());
                shippingAddress.street = [];
                shippingAddress.street[0]=$('[name="novaposhta_warehouse_ref"] option:selected').text();
                shippingAddress.city=$('[name="novaposhta_city_ref"] option:selected').text();
                console.log(shippingAddress);
            }

            shippingAddress['extension_attributes']['novaposhta_city_ref'] = $('[name="novaposhta_city_ref"]').val();
            shippingAddress['extension_attributes']['novaposhta_warehouse_ref'] = $('[name="novaposhta_warehouse_ref"]').val();

            return originalAction();
        });
    };
});
