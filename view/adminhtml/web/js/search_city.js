define(
    [
        'jquery',
        'Magento_Ui/js/modal/modal',
        'mage/url',
        'Magento_Ui/js/modal/alert'
    ]
    , function (
        $,
        modal,
        url,
        alert
    ) {
    'use strict';


        let options = {};
        let $myModal = null;
        let popup = null;


        function loadModal (url) {
            if (!$('input[name="description"]').val() || $('input[name="description"]').val().length < 3) {
                alert({content: "Please Enter full city name, or type 3 symbols to find them"});
                return false;
            }

            new Ajax.Request(url, {
                parameters: {
                    ajax:'open',
                    city: $('input[name="description"]').val()
                },
                onSuccess: function (response) {
                    $myModal.html(response.responseText);
                    $myModal.modal('openModal');
                    $('body').trigger('processStop');

                },
                onFailure: function (response) {
                    $('body').trigger('processStop');
                }
            });
        }

        function saveCityToDb(url, redirectUrl)
        {
            var searchRef = $(".city_ref:checked").map(function(){
                return $(this).val();
            }).get();

            if (searchRef.length == 0) {
                alert({content: "Please check city to Save them to DataBase"});
                return false;
            }

            new Ajax.Request(url, {
                parameters: {
                    ajax:'save',
                    citiesRef: JSON.stringify(searchRef)
                },
                onSuccess: function (response) {
                    window.location.href = redirectUrl;
                },
                onFailure: function (response) {
                    alert({content: "Error saving cities to DB"});
                    popup.closeModal();
                }
            });
        }

    return function (search_city) {

         options = {
            type: 'slide',
            responsive: true,
            innerScroll: true,
            title: 'Modal Title',
            modalClass: 'custom-modal',
            buttons: [{
                text: $.mage.__('Save and Continue'),
                class: 'primary save_city_to_db',
                click: function () {
                    saveCityToDb(search_city.saveUrl, search_city.redirectUrl);
                }
            }]
        };

         $myModal = $('#test-modal');
         popup = modal(options, $myModal);

        $(document).on('click', '#search_city', function () {
            loadModal(search_city.ajaxUrl);
        });
    }
});


