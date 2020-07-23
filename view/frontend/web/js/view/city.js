define([
    'jquery',
    'Magento_Ui/js/form/element/select',
    'Magento_Checkout/js/model/quote',
    'mage/url',
    'CodeCustom_NovaPoshta/js/model/city',
    'mage/translate',
], function ($, Select, quote, url, city) {
    'use strict';
    return Select.extend({

        defaults: {
            cityName: '',
            exports: {
                cityName: '${ $.parentName }.city:value'
            }
        },

        cities: {},

        initialize: function () {
            this._super();
            this.cityName(this.getPreview());
            var that = this;
            this.loadData();
            return this;
        },

        initObservable: function () {
            this._super();
            this.observe('cityName');
            return this;
        },

        getPreview: function () {
            return $('[name="' + this.inputName + '"] option:selected').text();
        },

        getCityName: function () {
            return this.cityName();
        },

        setDifferedFromDefault: function () {
            this._super();
            this.cityName(this.getPreview());
        },
        selectedMethodCode: function () {

            var method = quote.shippingMethod();
            var selectedMethodCode = method != null ? method.method_code : false;

            if (selectedMethodCode === 'novaposhta_shipping_warehouse') {

            }
            return selectedMethodCode;
        },
        onChangeElem: function (event) {
            var method = quote.shippingMethod();
            var selectedMethodCode = method != null ? method.method_code : false;

            if (selectedMethodCode === 'novaposhta_shipping_warehouse') {
                //city.getWarehouses();
            }

        },
        loadData: function () {
            var that = this;
            $.ajax({
                url: url.build('rest/V1/novaposhta/city/'),
                data: {},
                contentType: "application/json",
                type: "POST",
                dataType: 'json',
                error : function () {
                    console.log("An error have occurred.");
                },
                success : function (data) {
                    var items = JSON.parse(data);
                    that.setOptions(items);
                    return items;
                }
            });
        },

    });
});
