define([
    'jquery',
    'Magento_Ui/js/form/element/select',
    'Magento_Checkout/js/model/quote',
    'Magento_Customer/js/model/address-list',
    'mage/translate'
], function ($, Select, quote, addressList) {
    'use strict';


    return Select.extend({

        defaults: {
            warehouseName: '',
            exports: {
                warehouseName: '${ $.parentName }.shipping-address-fieldset.street.0:value'
            }
        },

        warehouses: {},

        initialize: function () {
            this._super();
            this.setOptions(this.warehouses);
            this.warehouseName(this.getPreview());
            return this;
        },

        initObservable: function () {
            this._super();
            this.observe('warehouseName');
            return this;
        },

        selectedMethodCode: function () {
            var method = quote.shippingMethod();
            var selectedMethodCode = method != null ? method.method_code : false;

            if (selectedMethodCode === 'novaposhta_shipping_warehouse') {

            }
            return selectedMethodCode;
        },

        setDifferedFromDefault: function () {
            this._super();
            this.warehouseName(this.getPreview());
        },

        setWarehouses: function (data) {
            this.clear();
            this.warehouses = data;
            this.setOptions(this.warehouses);

            if (addressList().length > 0) {
                var street = quote.shippingAddress().street[0];
                if (street != '' && street != undefined) {
                    $("[name='novaposhta_warehouse_ref'] option:contains(" + street + ")").attr('selected', 'selected');
                }
            }
        },

        loadData: function(element) {
            console.log(this.options());
        },

    });
});
