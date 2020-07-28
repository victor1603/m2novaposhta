define([
    'jquery',
    'Magento_Checkout/js/model/url-builder',
    'mage/storage',
    'uiRegistry',
    'Magento_Customer/js/model/address-list',
    'Magento_Checkout/js/model/quote',
    'mage/url',
    'Magento_Checkout/js/model/full-screen-loader',
    'loader',
    'jquery/ui',
], function ($, urlBuilder, storage, registry, addressList, quote, url,fullScreenLoader) {
    'use strict';
    return {
        getWarehouses: function () {
            var cityRef = $('select[name=novaposhta_city_ref]').val();
            if (cityRef && cityRef != undefined && parseInt(cityRef) != 0) {
                var dropdown = $('select[name=novaposhta_warehouse_ref]');
                fullScreenLoader.startLoader();
                $.ajax({
                    url: url.build('rest/V1/novaposhta/warehouse/'),
                    data: JSON.stringify({cityRef: cityRef}),
                    contentType: "application/json",
                    type: "POST",
                    dataType: 'json',
                    //showLoader: true,
                    error : function () {
                        console.log('Error loading data');
                        fullScreenLoader.stopLoader();
                    },
                    success : function (data) {
                        var items = JSON.parse(data);
                        dropdown.html("");
                        $.each(items, function (key, entry) {
                            dropdown.append($('<option></option>').attr('value', entry.id).text(entry.text));
                        });
                        fullScreenLoader.stopLoader();
                    }
                });
            }
        }
    };
})
