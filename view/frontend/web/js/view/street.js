define([
    'jquery',
    'Magento_Ui/js/form/element/select',
    'mage/url',
    'Magento_Checkout/js/model/quote',
    'mage/translate',
    'CodeCustom_NovaPoshta/js/lib/select2/select2'
], function ($, Select, url, quote) {
    'use strict';
    return Select.extend({

        defaults: {
            cityName: '',
            exports: {
                cityName: '${ $.parentName }.city:value'
            }
        },

        initialize: function () {
            this._super();
            this.cityName(this.getPreview());
            return this;
        },

        initObservable: function () {
            this._super();
            this.observe('cityName');
            return this;
        },

        select2: function (element) {
            var lang = "ru";
            $(element).select2({
                placeholder: $.mage.__('select street'),
                dropdownAutoWidth: true,
                width: $(element).parent().width().toString() + 'px',
                minimumInputLength: 2,
                language: lang,
                data: [{id:0,text:'enhancement'},{id:1,text:'bug'},{id:2,text:'duplicate'},{id:3,text:'invalid'},{id:4,text:'wontfix'}]
            });
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
        selectedMethodCode:function () {
            var method = quote.shippingMethod();
            var selectedMethodCode = method != null ? method.method_code : false;

            return selectedMethodCode;
        }

    });
});
