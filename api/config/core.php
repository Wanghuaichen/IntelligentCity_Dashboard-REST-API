<?php
 
// home page url
$home_url="http://fatihwebapp.azurewebsites.net/api/";
 

$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// set number of records per page
$records_per_page = 5;
 
$from_record_num = ($records_per_page * $page) - $records_per_page;
?>