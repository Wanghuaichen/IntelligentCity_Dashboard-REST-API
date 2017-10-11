$(document).ready(function(){
 
    $(document).on('click', '.update-product-button', function(){
        // get product id
		var id = $(this).attr('data-id');
		
$.getJSON("http://fatihwebapp.azurewebsites.net/api/product/read_one.php?id=" + id, function(data){
 
    var name = data.name;
    var sensor_value = data.sensor_value;
    var description = data.description;
    var category_id = data.category_id;
    var category_name = data.category_name;
     
    
	
	// load list of categories
$.getJSON("http://fatihwebapp.azurewebsites.net/api/category/read.php", function(data){
 
    var categories_options_html="";
    categories_options_html+="<select name='category_id' class='form-control'>";
 
    $.each(data.records, function(key, val){
         
        if(val.id==category_id){
            categories_options_html+="<option value='" + val.id + "' selected>" + val.name + "</option>";
        }
 
        else{
            categories_options_html+="<option value='" + val.id + "'>" + val.name + "</option>";
        }
    });
    categories_options_html+="</select>";
     
var update_product_html="";
 
update_product_html+="<div id='read-products' style='margin-bottom:10px' class='btn btn-primary pull-right read-products-button'>";
    update_product_html+="<span class='glyphicon glyphicon-list'></span> Tüm Sensörler";
update_product_html+="</div>";
update_product_html+="<form id='update-product-form' action='#' method='post' border='0'>";
    update_product_html+="<table class='table table-hover table-responsive table-bordered'>";
 
        // name
        update_product_html+="<tr>";
            update_product_html+="<td>İsim</td>";
            update_product_html+="<td><input value=\"" + name + "\" type='text' name='name' class='form-control' required /></td>";
        update_product_html+="</tr>";
 
        // sensor_value 
        update_product_html+="<tr>";
          //  update_product_html+="<td>Değer</td>";
           // update_product_html+="<td><input value=\"" + sensor_value + "\" type='number' min='1' name='sensor_value' class='form-control' required /></td>";
		    update_product_html+="<td><input value='1' type='hidden' min='1' name='sensor_value' class='form-control' required /></td>";
        update_product_html+="</tr>";
 
        // description 
        update_product_html+="<tr>";
            update_product_html+="<td>Açıklama</td>";
            update_product_html+="<td><textarea name='description' class='form-control' required>" + description + "</textarea></td>";
        update_product_html+="</tr>";
 
        // categories
        update_product_html+="<tr>";
            update_product_html+="<td>Kategori</td>";
            update_product_html+="<td>" + categories_options_html + "</td>";
        update_product_html+="</tr>";
 
        update_product_html+="<tr>";
 
            // product id
            update_product_html+="<td><input value=\"" + id + "\" name='id' type='hidden' /></td>";
 
            // submit
            update_product_html+="<td>";
                update_product_html+="<button type='submit' class='btn btn-info'>";
                    update_product_html+="<span class='glyphicon glyphicon-edit'></span> Güncelle";
                update_product_html+="</button>";
            update_product_html+="</td>";
 
        update_product_html+="</tr>";
 
    update_product_html+="</table>";
update_product_html+="</form>";

// inject to page content
$("#page-content").html(update_product_html);
 
// chage page title
changePageTitle("Veri Güncelle");
	
});
	
	
});
		
		
		
		
    });
     
$(document).on('submit', '#update-product-form', function(){
     
    // get form data
var form_data=JSON.stringify($(this).serializeObject());
// submit form data to api
$.ajax({
    url: "http://fatihwebapp.azurewebsites.net/api/product/update.php",
    type : "POST",
    contentType : 'application/json',
    data : form_data,
    success : function(result) {
       
        showProductsFirstPage();
		
    },
    error: function(xhr, resp, text) {
      
        console.log(xhr, resp, text);
    }
});
     
    return false;
});


});