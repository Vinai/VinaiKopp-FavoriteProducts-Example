define(['jquery'], function ($) {
    'use strict';
    
    const favoriteSkus = function () {
        return ['24-WB05', '24-MB01'];
    };
    
    const isFavorite = function (sku) {
        return -1 !== favoriteSkus().indexOf(sku);
    };
    
    return function(config) {
        this.isFavorite = isFavorite;
        this.select = function(sku) {
            return function() {
                const url = config.update_url + sku;
                if (isFavorite(sku)) {
                    $.ajax(url, {method: 'DELETE'});
                } else {
                    $.ajax(url, {method: 'POST'});
                }
            }
        };
    };
});
