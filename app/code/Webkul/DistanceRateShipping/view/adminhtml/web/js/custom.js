/**
 * Webkul DistanceRateShipping requirejs.
 * @category  Webkul
 * @package   Webkul_DistanceRateShipping
 * @author    Webkul
 * @copyright Copyright (c) Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
require(
    [
        'jquery',
        'mage/translate',
    ],
    function ($) {  
        $("#wk_distancerateshipping_general_settings_latitude").attr('readonly','readonly');
        $("#wk_distancerateshipping_general_settings_longitude").attr('readonly','readonly');
       if($("#wk_distancerateshipping_general_settings_location").length){
        var autocomplete = new google.maps.places.Autocomplete($("#wk_distancerateshipping_general_settings_location")[0], {});
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();
            $("#wk_distancerateshipping_general_settings_latitude").val(place.geometry.location.lat().toFixed(5));
            $("#wk_distancerateshipping_general_settings_longitude").val(place.geometry.location.lng().toFixed(5));
        });
    }
    }
);