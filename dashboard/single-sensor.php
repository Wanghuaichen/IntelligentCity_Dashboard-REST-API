<?php 
include("header.php");

$id = $_GET['sensor_id'];

$value_list = json_decode(file_get_contents('http://fatihwebapp.azurewebsites.net/api/product/read_one_sensor.php?id='.$id));

?>
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->

<script>
$(document).ready(function(){
	setInterval(function(){
		$("#screen").load('widget.php?content=widget&id=<?php echo $id;?>')
		$("#sensor-value-table").load('widget.php?content=sensor-list&id=<?php echo $id;?>')
    }, 2000);
});
</script>
<div id="screen"></div>
<div class="row">
                <div class="col-sm-6">
                    <section class="panel">
                        <header class="panel-heading">
                           <?php echo $value_list->sensor_values[0]->sensor_name ?>
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                        </header>
                        <div class="panel-body">
                            <div id="single-sensor-graph-line"></div>
                        </div>
                    </section>
                </div>
                
                
                <!-- real time chart -->
 				<div class="col-sm-6">
                    <section class="panel">
                        <header class="panel-heading">
                            Gerçek Zamanlı Grafik
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                            <a href="javascript:;" class="fa fa-times"></a>
                         </span>
                        </header>
                        <div class="panel-body">
                            <div id="reatltime-chart">
                                <div id="reatltime-chartContainer" style="width:100%;height:300px; text-align: center; margin:0 auto;">
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
<!--end of real time chart -->
                
       </div>

		<!--sensor value table -->
      <div id="sensor-value-table"></div>
        
        <!-- page end-->
        </section>
    </section>
    <!--main content end-->
<!--right sidebar start-->
<div class="right-sidebar">
<div class="right-stat-bar">
<ul class="right-side-accordion">
<li class="widget-collapsible">
    <ul class="widget-container">
        <li>
            <div class="prog-row side-mini-stat clearfix">
                <div class="side-mini-graph"><div class="target-sell"></div></div>
            </div>
            <div class="prog-row side-mini-stat">
            </div>
        </li>
    </ul>
</li>
</ul>
</div>
</div>
<!--right sidebar end-->

</section>



<script type="text/javascript">
var day_data = [
   <?php foreach($value_list->sensor_values as $value){
						echo '
                      {"elapsed": "'.substr($value->measurement_date, 0, strpos($value->measurement_date, '.')).'", "CO Degeri": '.$value->sensor_value.'},';
						}?>
];
new Morris.Line({
    element: 'single-sensor-graph-line',
    data: day_data,
    xkey: 'elapsed',
    ykeys: ['CO Degeri'],
    labels: ['CO Degeri'],
    lineColors:['#1FB5AD'],
    parseTime: false
});
</script>
<?php  include("footer.php");?>

<script type="text/javascript">

//fatih 
$(function() {
	
	
	var latest_value= 0;
	
	function reload_cart() {
		$.getJSON("http://fatihwebapp.azurewebsites.net/api/product/read_one_sensor.php?id=<?php echo $id; ?>", function (json) {
			
   		latest_value = json.sensor_values[0].sensor_value;
		
		//return sensor;		
   		});
        return latest_value;
    }
	 $(function() {
        var data1 = [];
        var totalPoints = 200;
        function GetData() {
        data1.shift();
		
		
		
      while (data1.length < totalPoints) {
        /*
		var prev = data1.length > 0 ? data1[data1.length - 1] : 50;
        var y = prev + Math.random() * 10 - 5;
        y = y < 0 ? 0 : (y > 100 ? 100 : y);
		*/
		
		var y =  reload_cart();
		
		
        data1.push(y);
        }
    var result = [];
    for (var i = 0; i < data1.length; ++i) {
        result.push([i, data1[i]])
        }
    return result;
    }
    var updateInterval = 100;
    var plot = $.plot($("#reatltime-chart #reatltime-chartContainer"), [
            GetData()], {
            series: {
                lines: {
                    show: true,
                    fill: true
                },
                shadowSize: 0
            },
            yaxis: {
                min: 0,
                max: 300,
                ticks: 10
            },
            xaxis: {
                show: false
            },
            grid: {
                hoverable: true,
                clickable: true,
                tickColor: "#f9f9f9",
                borderWidth: 1,
                borderColor: "#eeeeee"
            },
            colors: ["#79D1CF"],
            tooltip: true,
            tooltipOpts: {
                defaultTheme: false
            }
        });
        function update() {
            plot.setData([GetData()]);
            plot.draw();
            setTimeout(update, updateInterval);
        }
		
        update();
		
		
		
    });
	
});
</script>