define(['jquery', 'Magento_Customer/js/customer-data'], function ($, customer_data) {
    'use strict';
    
    const section_name = 'vinaikopp_favoriteproducts';
    const favoriteSkus = function () {
        const favorites = customer_data.get(section_name);
        return favorites().skus || [];
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
