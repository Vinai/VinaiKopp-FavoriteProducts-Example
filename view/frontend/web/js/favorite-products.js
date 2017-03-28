define(['jquery', 'Magento_Customer/js/customer-data'], function ($, customer_data) {
    "use strict";
    
    const section_name = 'vinaikopp_favoriteproducts';
    var favoriteSkus = function () {
        const favorites = customer_data.get(section_name);
        return favorites().skus || [];
    };
    
    var isFavorite = function (sku) {
        return -1 !== favoriteSkus().indexOf(sku);
    };
    
    return function(config) {
        this.isFavorite = isFavorite;
        this.select = function(sku) {
            return function() {
                const url = config.update_url + sku;
                if (isFavorite(sku)) {
                    customer_data.invalidate([section_name]);
                    $.ajax(url, {method: 'DELETE'}).done(function() {customer_data.reload([section_name], true);});
                } else {
                    $.ajax(url, {method: 'POST'});
                }
            }
        };
    };
});
