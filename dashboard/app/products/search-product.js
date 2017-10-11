$(document).ready(function(){
 
    $(document).on('submit', '#search-product-form', function(){
 
        // get search keywords
        var keywords = $(this).find(":input[name='keywords']").val();
 
        // get data from the api based on search keywords
        $.getJSON("http://fatihwebapp.azurewebsites.net/api/product/search.php?s=" + keywords, function(data){
 
            // template in products.js
            readProductsTemplate(data, keywords);
 
            // chage page title
            changePageTitle("Sensör Arama: " + keywords);
 
        });
 
        return false;
    });
 
});