<?php 

$content = $_GET['content'];
$value_list = json_decode(file_get_contents('http://fatihwebapp.azurewebsites.net/api/product/read_one_sensor.php?id='.$_GET['id']));


if($content == "widget"){
	echo '<div class="row">
    <div class="col-md-3">
        <div class="mini-stat clearfix">
            <span class="mini-stat-icon orange"><i class="fa fa-cloud"></i></span>
            <div class="mini-stat-info">
             Son değer
                <span>'.$value_list->sensor_values[0]->sensor_value.' PPM</span>
              Son Okunma: <b>'.substr($value_list->sensor_values[0]->measurement_date, 0, strpos($value_list->sensor_values[0]->measurement_date, ".")).'</b>
            </div>
        </div>
    </div>';
  }
  
  else if($content == "sensor-list"){
	  echo'<div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                       Ölçüm Değerleri
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header>
                    <div class="panel-body"><h3>"'.$value_list->sensor_values[0]->sensor_name.'" Ölçüm Değerleri</h3>
                    <div class="adv-table">
                    <table  class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>#Ölçüm ID</th>
                        <th>Sensör Değeri</th>
                        <th>Ölçüm Tarihi</th>
                        
                    </tr>
                    </thead>
                    <tbody>';                
                    foreach($value_list->sensor_values as $value){
						echo '<tr class="">
                        <td>'.$value->measurement_id.'</td>
                        <td>'.$value->sensor_value.'</td>
                        <td>'.substr($value->measurement_date, 0, strpos($value->measurement_date, '.')).'</td>
                    </tr>';
						} 
                   echo' </tbody>
                    <tfoot>
                    <tr>
                        <th>#Ölçüm ID</th>
                        <th>Sensör Değeri</th>
                        <th>Ölçüm Tarihi</th>
                        
                    </tr>
                    </tfoot>
                    </table>
                    </div>
                    </div>
                </section>
            </div>
        </div>';
	  }
	  



?>