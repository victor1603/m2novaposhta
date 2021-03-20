define([
    'jquery',
    'Magento_Ui/js/form/element/select',
    'Magento_Checkout/js/model/quote',
    'mage/url',
    'CodeCustom_NovaPoshta/js/model/city',
    'mage/translate',
    'CodeCustom_NovaPoshta/js/lib/select2/select2'
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

        select2: function (element) {
            var that = this;
            var cities = that.cities
            $.fn.select2.amd.require(["select2/data/array", "select2/utils"],
            function (ArrayData, Utils) {
                function CustomData($element, options) {
                    CustomData.__super__.constructor.call(this, $element, options);
                }
                Utils.Extend(CustomData, ArrayData);

                CustomData.prototype.query = function (params, callback) {

                    var pageSize = 50;
                    var results = [];

                    if (params.term && params.term !== '') {
                        results = _.filter(cities, function(e) {
                            return e.text != null ? e.text.toUpperCase().indexOf(params.term.toUpperCase()) >= 0 : false;
                        });
                    } else {
                        results = cities;
                    }

                    if (!("page" in params)) {
                        params.page = 1;
                    }
                    var data = {};
                    data.results = results.slice((params.page - 1) * pageSize, params.page * pageSize);
                    data.pagination = {};
                    data.pagination.more = params.page * pageSize < results.length;
                    callback(data);
                };

                $(element).select2({
                    data: cities,
                    ajax: {},
                    dataAdapter: CustomData
                });
            })
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

            if (selectedMethodCode === 'novaposhtashippingkiev') {
                //city.getWarehouses(selectedMethodCode);
            }
            return selectedMethodCode;
        },
        onChangeElem: function (event) {
            var method = quote.shippingMethod();
            var selectedMethodCode = method != null ? method.method_code : false;

            if (selectedMethodCode === 'novaposhtashippingwarehouse' ||
                selectedMethodCode === 'novaposhtashippingkiev') {
                //city.getWarehouses(selectedMethodCode);
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
                    that.cities = items;
                    return items;
                }
            });
        },

    });
});
