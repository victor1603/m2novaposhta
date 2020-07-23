define(
    [],
    function () {
        "use strict";
        return {
            getRules: function () {
                return {
                    'postcode': {
                        'required': false
                    },
                    'country_id': {
                        'required': false
                    },
                    'region': {
                        'required': false
                    },
                    'region_id': {
                        'required': false
                    },
                    'novaposhta_city_ref': {
                        'required': false
                    },
                    'novaposhta_warehouse_ref': {
                        'required': false
                    },
                };
            }
        };
    }
);
