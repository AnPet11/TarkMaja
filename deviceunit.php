<form method="POST">
<div class="switch">
	<input type="submit" value= "Lülita sisse" name="sisse<?php echo $array[$i][0] ; ?>" id="sisse<?php echo $array[$i][0] ; ?>">
	<input type="submit" value= "Lülita välja" name ="v2lja<?php echo $array[$i][0] ; ?>" id="v2lja<?php echo $array[$i][0] ; ?>">
</div><br>
<p>Seadme võimsus: <?php echo $array[$i][5] ; ?></p>
<div id="chartContainer<?php echo $array[$i][0] ; ?>" style="height: 300px; width: 100%;">
</div>
	<input type="button" value="Tingimused" onclick="window.location.href='tingimused.php'" />
<br><br>
	<div class="manage">
		<input type="submit" value="Uuenda" name="uuenda<?php echo $array[$i][0] ; ?>" id="uuenda<?php echo $array[$i][0] ; ?>">
		<input type="submit" value="Kustuta" name="kustuta<?php echo $array[$i][0] ; ?>" id="kustuta<?php echo $array[$i][0] ; ?>">			
	</div><br><br>

<table style="width:100%">
<style>
table, th, td {
  border: 1px solid black;
}
</style>
  <tr>
    <th>Seade</th>
    <th>Sisse</th>
    <th>Välja</th>
    <th>Viga</th>
  </tr>
<?php 
for ($j = 0; $j < $linecountstat; $j++){
	if ($stat[$j][1]==$array[$i][0]){
		echo '<tr>';
		echo '  <td>' .$array[$stat[$j][1]-1][4] .'</td>';
		echo '  <td>' .$stat[$j][2] .'</td>';
		echo '  <td>' .$stat[$j][3] .'</td>';
		echo '  <td>' .$stat[$j][4] .'</td>';
		echo '</tr>';
	}
}	
?>
</table>
</form>