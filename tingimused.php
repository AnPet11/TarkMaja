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
	
	if(isset($_POST["startTime"]) && isset($_POST["deviceinput"]) && isset($_POST["stopTime"]) && isset($_POST["tingimus"]) && !empty($_POST["startTime"]) && !empty($_POST["deviceinput"]) && !empty($_POST["stopTime"]) && !empty($_POST["tingimus"])){
		$array[$_POST["deviceinput"]-1][1] = $_POST["startTime"];
		$array[$_POST["deviceinput"]-1][2] = $_POST["stopTime"];
		$array[$_POST["deviceinput"]-1][3] = $_POST["tingimus"];
		
		$write_handle = fopen("tingimused.txt", "w");
	
		for($i=0; $i<$linecount;$i++){
			$array[$i]=implode(',',$array[$i]);
		}
		$all_text=implode($array);
		echo $all_text;
		file_put_contents('tingimused.txt', $all_text);
		fclose($write_handle);
	}
	
	
	
    require("header.php");
?>

<!DOCTYPE html>
<html lang="en">
<body>
<div class="container">
  <div id="pealkiri">
		<h1>Tingimused</h1>
	</div>
  <div id="seadmed">
	
  
    <div>
  <br>
  <div id="sisu">
    <form method="POST">
	<div id="sissejuhatus">
	<legend>Millist seadet haldad?</legend>
	<select name="deviceinput" id="deviceinput" onchange="doChange()">
	<option value="" selected disabled>Seade</option>
	<?php for ($i= 0; $i < $linecount; $i++){
		echo '<option value="' .$array[$i][0] .'"';
		echo ">" .$array[$i][4] ."</option> \n";
	}?>
	</select>
	<br>
	<script type="text/javascript"> 
		var array = <?php echo json_encode($array); ?>;
		var device = document.getElementById("deviceinput");
		var tingimus = document.getElementById("tingimus");
		
		function doChange() {
			var device = document.getElementById("deviceinput");
			var start = document.getElementById("startTime");
			var stop = document.getElementById("stopTime");
			var tingimus = document.getElementById("tingimus");
			start.value=array[device.value-1][1];
			stop.value=array[device.value-1][2];
			tingimus.value=array[device.value-1][3];
        }
		function howLong(){
		  var total_text=document.getElementsByClassName("howLong");
		  total_text=total_text.length+1;
		  document.getElementById("field_div").innerHTML=document.getElementById("field_div").innerHTML+
		  "<p id='howLong"+total_text+"_wrapper'><input type='text' class='howLong' name='startTime' value='"+array[device.value-1][1]+"' id='howLong"+total_text+"' placeholder='Kui kaua seade töötab'><input type='button' value='Remove' onclick=remove_field('howLong"+total_text+"');></p>";
		}

		function whatTime(){
		  var total_text=document.getElementsByClassName("whatTime");
		  total_text=total_text.length+1;
		  document.getElementById("field_div").innerHTML=document.getElementById("field_div").innerHTML+
		  "<p id='whatTime"+total_text+"_wrapper'><input type='text' class='whatTime' name='stopTime' value='"+array[device.value-1][2]+"' id='whatTime"+total_text+"' placeholder='Mis kellast, mis kellani'><input type='button' value='Remove' onclick=remove_field('whatTime"+total_text+"');></p>";
		}

		function remove_field(id){
		  document.getElementById(id+"_wrapper").innerHTML="";
		}	
          
    </script>
	  <legend>Sistesta ülemine hinnapiir</legend>
        <input type="text"  name="tingimus" value="">
      <br><br>
      <div id="field_div">
				</div>
			<input type="button" value="Kui kaua" onclick="howLong();">
			<br>
			<input type="button" value="Mis Kell" onclick="whatTime();">
			<br>
        <input type="submit" name="submit" value="Salvesta">
    </form>
		</div>
  </div>
	</div>
	</div>
</body>
</div>
</html>