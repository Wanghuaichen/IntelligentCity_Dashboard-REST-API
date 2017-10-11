$(document).ready(function(){
 
    $(document).on('click', '.create-product-button', function(){
        
		// load list of categories
	$.getJSON("http://fatihwebapp.azurewebsites.net/api/category/read.php", function(data){
		
		
		var categories_options_html="";
		categories_options_html+="<select name='category_id' class='form-control'>";
	$.each(data.records, function(key, val){
    	categories_options_html+="<option value='" + val.id + "'>" + val.name + "</option>";
	});
		categories_options_html+="</select>";
		
		
var create_product_html="";
 
create_product_html+="<div id='read-products' class='btn btn-primary pull-right m-b-15px read-products-button'>";
    create_product_html+="<span class='glyphicon glyphicon-list'></span> Tüm Sensörler";
create_product_html+="</div>";
		
		
		// create sensor html form
create_product_html+="<form id='create-product-form' action='#' method='post' border='0'>";
    create_product_html+="<table class='table table-hover table-responsive table-bordered'>";
 
        // name field
        create_product_html+="<tr>";
            create_product_html+="<td>İsim</td>";
            create_product_html+="<td><input type='text' name='name' class='form-control' required /></td>";
        create_product_html+="</tr>";
 
        // sensor_value field
        create_product_html+="<tr>";
            create_product_html+="<td>Değer</td>";
            create_product_html+="<td><input type='number' min='1' name='sensor_value' class='form-control' required /></td>";
        create_product_html+="</tr>";
 
        // description field
        create_product_html+="<tr>";
            create_product_html+="<td>Açıklama</td>";
            create_product_html+="<td><textarea name='description' class='form-control' required></textarea></td>";
        create_product_html+="</tr>";
 
        // categories select field
        create_product_html+="<tr>";
            create_product_html+="<td>Kategori</td>";
            create_product_html+="<td>" + categories_options_html + "</td>";
        create_product_html+="</tr>";
 
        // button to submit form
        create_product_html+="<tr>";
            create_product_html+="<td></td>";
            create_product_html+="<td>";
                create_product_html+="<button type='submit' class='btn btn-primary'>";
                    create_product_html+="<span class='glyphicon glyphicon-plus'></span> Oluştur";
                create_product_html+="</button>";
            create_product_html+="</td>";
        create_product_html+="</tr>";
 
    create_product_html+="</table>";
create_product_html+="</form>";


// inject html
$("#page-content").html(create_product_html);
 
// chage page title
changePageTitle("Yeni Ekle");
	});  // end list of categories
		
    });
 
    // create product form
$(document).on('submit', '#create-product-form', function(){
   // get form data
var form_data=JSON.stringify($(this).serializeObject());
// submit form data to api
$.ajax({
    url: "http://fatihwebapp.azurewebsites.net/api/product/create.php",
    type : "POST",
    contentType : 'application/json',
    data : form_data,
    success : function(result) {
        showProducts();
    },
    error: function(xhr, resp, text) {
        console.log(xhr, resp, text);
    }
});
 
return false;
	
});


});