<?php
	$file="tingimused.txt";
	$linecount = 0;
	$handle = fopen($file, "r");
	while(!feof($handle)){
	  $line = fgets($handle);
	  $linecount++;
	}
	fclose($handle);

	
	$file_handle = fopen("tingimused.txt", "r");
	$array = array($linecount);
	$line = 0;
	while (!feof($file_handle) ) {
		$line_of_text = fgets($file_handle);
		$parts = explode(',', $line_of_text);
		$array[$line]=$parts;
		$line++;
	}
	echo $array[0][0];
	fclose($file_handle);
	
	$filestats="stat.txt";
	$linecountstat = 0;
	$handlestat = fopen($filestats, "r");
	while(!feof($handlestat)){
	  $linestat = fgets($handlestat);
	  $linecountstat++;
	}
	fclose($handlestat);

	
	$file_handle_stat = fopen("stat.txt", "r");
	$stat = array($linecountstat);
	$linestat = 0;
	while (!feof($file_handle_stat) ) {
		$line_of_text_stat = fgets($file_handle_stat);
		$partsstat = explode(',', $line_of_text_stat);
		$stat[$linestat]=$partsstat;
		$linestat++;
	}
	echo $stat[0][0];
	fclose($file_handle_stat);
	
	for	($i=0;$i<$linecount;$i++){
		
		if (isset($_POST["sisse" .($i+1)])){
			$switch=file_get_contents("status.txt");
			$switch_array = explode("\n", $switch);
			$switch_array[$i]=1;
			file_put_contents("status.txt", implode("\n",$switch_array));
		}
		if (isset($_POST["v2lja" .($i+1)])){
			$switch=file_get_contents("status.txt");
			$switch_array = explode("\n", $switch);
			$switch_array[$i]=0;
			file_put_contents("status.txt", implode("\n",$switch_array));
		}
		if (isset($_POST["uuenda" .($i+1)])){
			exec('python uuenda.py');
			exec('python statistika.py');
		}
		if (isset($_POST["kustuta" .($i+1)])){
			$switch=file_get_contents("tingimused.txt");
			$switch_array = explode("\n", $switch);
			array_splice($switch_array,$i,1);
			file_put_contents("tingimused.txt", implode("\n",$switch_array));
		}
	}	
    require("header.php");
?>
<!DOCTYPE html>
<html lang="et">
<body>
<div class="container">
    <h1>Seadmed</h1><br><br>
	<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
	<script type="text/javascript">
function myFunction(number,iterable) {
  var x = document.getElementById("myDiv"+number);
  if (x.style.display === "none") {
    x.style.display = "block";
	var l;
	for(l = 0; l < array.length; l++)
		if (number!=array[l][0]) {
			var y = document.getElementById("myDiv"+array[l][0]);
			y.style.display = "none";
		}
  } else {
    x.style.display = "none";
  }
  getChart(number,iterable);
}
  var array = <?php echo json_encode($array); ?>;
  var dataPoints = [];	
function getDataPointsFromCSV(csv,device_id) {
    var dataPoints = csvLines = points = [];
	
    csvLines = csv.split(/[\r?\n|\r|\n]+/);
        
    for (var i = 0; i < csvLines.length; i++)
        if (csvLines[i].split(",")[0]==device_id) {
            points = csvLines[i].split(",").slice(1,-1);
			for (var j = 0; j < points.length/2; j++)
				dataPoints.push({ 
					x: new Date(points[j*2]), 
					y: parseFloat(points[j*2+1]) 		
	    });
	}
    return dataPoints;
}
function getChart(device_id,i) {
$.get("sorted.csv", function(data) {
	var chart = new CanvasJS.Chart("chartContainer"+device_id, {
		title: {
		text: array[i][4],
		},
		data: [{
		type: "line",
		dataPoints: getDataPointsFromCSV(data,device_id)
	}]
	});
	chart.render();
});
}
</script>
<?php
for ($i= 0; $i < $linecount; $i++){
	echo ('<h2 onclick="myFunction(' .$array[$i][0] .',' .$i .')">' .$array[$i][4] .'</h2>');
	echo ('<div class="container" id="myDiv' .$array[$i][0] .'" style="display:none">');
	include("deviceunit.php");
	echo ('</div>');
}
?>
</div>
</body>
</html>
