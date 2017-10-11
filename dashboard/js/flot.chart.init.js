
//fatih 
$(function() {
	
	
	var latest_value= 0;
	
	function reload_cart() {
		$.getJSON("http://fatihwebapp.azurewebsites.net/api/product/read_one_sensor.php?id=18", function (json) {
			
   		latest_value = json.sensor_values[0].sensor_value;
		
		//return sensor;		
   		});
        return latest_value;
    }
	 $(function() {
        var data1 = [];
        var totalPoints = 300;
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
                max: 100,
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