define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/shipping-rates-validator',
        'Magento_Checkout/js/model/shipping-rates-validation-rules',
        'CodeCustom_NovaPoshta/js/model/shipping-rates-validator',
        'CodeCustom_NovaPoshta/js/model/shipping-rates-validation-rules'
    ],
    function (
        Component,
        defaultShippingRatesValidator,
        defaultShippingRatesValidationRules,
        shippingRatesValidator,
        shippingRatesValidationRules
    ) {
        'use strict';

        defaultShippingRatesValidator.registerValidator('novaposhta_shipping_warehouse', shippingRatesValidator);
        defaultShippingRatesValidationRules.registerRules('novaposhta_shipping_warehouse', shippingRatesValidationRules);

        return Component;
    }
);
