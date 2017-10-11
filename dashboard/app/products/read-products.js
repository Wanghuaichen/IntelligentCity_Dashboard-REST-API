//http://localhost:8888/api/product/read.php

$(document).ready(function(){
 
    showProductsFirstPage();
 
    $(document).on('click', '.read-products-button', function(){
        showProductsFirstPage();
    });
 
    $(document).on('click', '.pagination li', function(){
        // get json url
        var json_url=$(this).find('a').attr('data-page');
 
        // show list of products
        showProducts(json_url);
    });
 
 
});
 
function showProductsFirstPage(){
    var json_url="http://fatihwebapp.azurewebsites.net/api/product/read_paging.php";
    showProducts(json_url);
}
 

function showProducts(json_url){
    $.getJSON(json_url, function(data){
 
        
        readProductsTemplate(data, "");
 
        // chage page title
        //changePageTitle("Sensör Verileri");
 
    });
}


$(document).on('click', '.read-products-button', function(){
    showProducts();
});

