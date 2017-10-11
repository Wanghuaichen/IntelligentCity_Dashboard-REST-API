<?php 
include ("header.php");


//for debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//

$sensor_datas = json_decode(file_get_contents('http://fatihwebapp.azurewebsites.net/api/product/read_sensor.php'));
$sensor_list = json_decode(file_get_contents('http://fatihwebapp.azurewebsites.net/api/product/read.php'));
$graph_datas = json_decode(file_get_contents('http://fatihwebapp.azurewebsites.net/api/product/graph_test.php'));



?>


    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

        <!-- morris deneme -->
        
        <!-- morris bitti -->
        
       
        <!-- page start-->
            <div class="row">
                <div class="col-sm-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Tüm Sensörler
                        </header>
                        <div class="panel-body">
                            <div id="sensor-value-area"></div>
                        </div>
                    </section>
                </div>
            </div>
            
            <!-- sensor list -->
            <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                       Sensör Listesi
                    </header>
                    <div class="panel-body">
                        <table class="table  table-hover general-table">
                            <thead>
                            <tr>
                            <th>#id</th>
                                <th> Sensör Ad</th>
                                <th class="hidden-phone">Açıklama</th>
                                <th>Kategori</th>
                                <th>Durum</th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            
                            <?php 
							
								foreach($sensor_list->records as $sensor){
								echo '<tr>
								<td><a href="single-sensor.php?sensor_id='.$sensor->id.'">'.$sensor->id.'</a></td>
                                <td><a href="single-sensor.php?sensor_id='.$sensor->id.'">'.$sensor->name.'<a/></td>
                                <td class="hidden-phone"><a href="single-sensor.php?sensor_id='.$sensor->id.'">'.$sensor->description.'<a/></td>
								<td>'.$sensor->category_name.'</td>
                                <td><span class="label label-success label-mini">Aktif</span></td>
                                
                            </tr>';
}
							?>
                           
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
            </div>
			<!-- end of sensor list -->
            
      
        <div class="row" style="display:none">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                       Bar Chart
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                        <div id="graph-bar"></div>
                    </div>
                </section>
            </div>
        </div>
            
            <div class="row" style="display:none">
                <div class="col-sm-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Area Chart
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                        </header>
                        <div class="panel-body">
                            <div id="graph-area-line"></div>
                        </div>
                    </section>
                </div>
                <div class="col-sm-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Donut Chart
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-cog"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                        </header>
                        <div class="panel-body">
                            <div id="graph-donut"></div>
                        </div>
                    </section>
                </div>
            </div>
        
            
        <!-- page end-->
        </section>
    </section>
    <!--main content end-->

<script type="text/javascript">
new Morris.Area({
    element: 'sensor-value-area',
    behaveLikeLine: true,
    gridEnabled: false,
    gridLineColor: '#dddddd',
    axes: true,
    fillOpacity:.7,
    data: [
         <?php	
			foreach($graph_datas as $graph_data)
			{  
		echo "{period: '".substr($graph_data->period, 0, strpos($graph_data->period, '.'))."', baca1: ".$graph_data->baca1.", baca2: ".$graph_data->baca2.", baca3: ".$graph_data->baca3."},";
		}
			?>
    ],
    lineColors:['#E67A77','#D9DD81','#79D1CF'],
    xkey: 'period',
	xLabels: 'day',
    ykeys: ['baca1', 'baca2', 'baca3'],
    labels: ['Baca 1', 'Baca 2', 'Baca 3'],
    pointSize: 0,
    lineWidth: 0,
    hideHover: 'auto'

});

</script>

<?php  include ("footer.php");?>