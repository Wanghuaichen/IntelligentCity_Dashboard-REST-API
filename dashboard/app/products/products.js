// sensor list html
function readProductsTemplate(data, keywords){
 
    var read_products_html="";
 
    // search sensor form
    read_products_html+="<form id='search-product-form' action='#' method='post'>";
    read_products_html+="<div class='input-group pull-left w-30-pct'>";
 
        read_products_html+="<input type='text' value=\"" + keywords + "\" name='keywords' class='form-control product-search-keywords' placeholder='Sensör ara...' />";
 
        read_products_html+="<span class='input-group-btn'>";
            read_products_html+="<button type='submit' class='btn btn-default' type='button'>";
                read_products_html+="<span class='glyphicon glyphicon-search'></span>";
            read_products_html+="</button>";
        read_products_html+="</span>";
 
    read_products_html+="</div>";
    read_products_html+="</form>";
 
   
    read_products_html+="<div id='create-product' style='margin-top:10px;margin-bottom:10px' class='btn btn-primary pull-right create-product-button'>";
        read_products_html+="<span class='glyphicon glyphicon-plus'></span> Yeni Ekle";
    read_products_html+="</div>";
 
    // start table
    read_products_html+="<table class='table table-bordered table-hover'>";
 
       
        read_products_html+="<tr>";
            read_products_html+="<th class='w-25-pct'>İsim</th>";
            read_products_html+="<th class='w-10-pct'>Açıklama</th>";
            read_products_html+="<th class='w-15-pct'>Kategori</th>";
            read_products_html+="<th class='w-25-pct text-align-center'>Aksiyon</th>";
        read_products_html+="</tr>";
 
    // returned list of data
    $.each(data.records, function(key, val) {
 
       
        read_products_html+="<tr>";
 
            read_products_html+="<td>" + val.name + "</td>";
            read_products_html+="<td>" + val.description + "</td>";
            read_products_html+="<td>" + val.category_name + "</td>";
 
            // sensor action buttons
            read_products_html+="<td>";
			
	
                // read product button
               // read_products_html+="<button class='btn btn-primary read-one-product-button' data-id='" + val.id + "'>";
                   // read_products_html+="<span class='glyphicon glyphicon-eye-open'></span> Oku";
                //read_products_html+="</button>&nbsp;";
 
                // edit button
                read_products_html+="<button class='btn btn-info update-product-button' data-id='" + val.id + "'>";
                    read_products_html+="<span class='glyphicon glyphicon-edit'></span> Düzenle";
                read_products_html+="</button>&nbsp;";
 
                // delete button
                read_products_html+="<button class='btn btn-danger delete-product-button' data-id='" + val.id + "'>";
                    read_products_html+="<span class='glyphicon glyphicon-remove'></span> Sil";
                read_products_html+="</button>";
            read_products_html+="</td>";
 
        read_products_html+="</tr>";
 
    });
 
    // end table
    read_products_html+="</table>";
	
	// pagination
if(data.paging){
    read_products_html+="<ul class='pagination pull-left margin-zero padding-bottom-2em'>";
 
        // first page
        if(data.paging.first!=""){
            read_products_html+="<li><a data-page='" + data.paging.first + "'>İlk Sayfa</a></li>";
        }
 
        // pages
        $.each(data.paging.pages, function(key, val){
            var active_page=val.current_page=="yes" ? "class='active'" : "";
            read_products_html+="<li " + active_page + "><a data-page='" + val.url + "'>" + val.page + "</a></li>";
        });
 
        // last page
        if(data.paging.last!=""){
            read_products_html+="<li><a data-page='" + data.paging.last + "'>Son Sayfa</a></li>";
        }
    read_products_html+="</ul>";
}
 
    // inject to page
    $("#page-content").html(read_products_html);
}