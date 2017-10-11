$(document).ready(function(){
 
    // app html
    app_html="";
 
    app_html+="<div class='container'>";
        
        // this is where the contents will be shown.
    app_html+="<div id='page-content'></div>";
 
    app_html+="</div>";
 
    // inject to 'app' in index.html
    $("#app").html(app_html);
 
});
 
function changePageTitle(page_title){
 
    	// change page title
    $('#page-title').text(page_title);
 
    // change title tag
    document.title=page_title;
}
 
// json format
$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};