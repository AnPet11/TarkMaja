function aeg(){
	
	var array = '<?=$jsarray?>';
	console.log(array); // STRING
	array = JSON.parse(array);
	console.log(array);
	
	var device = document.getElementById("deviceinput");
	var starttime = document.getElementById("startTime");
	var stoptime = document.getElementById("stopTime");
	var tingimus = document.getElementById("tingimus");

	starttime.value=array[device.value][1];
	stoptime.value=array[device.value][2];
	tingimus.value=array[device.value][3];
	
	var myInput = document.getElementById('deviceinput').value;  
    document.getElementById('abhijeet').innerHTML = myInput;

}

function howLong(){
  var total_text=document.getElementsByClassName("howLong");
  total_text=total_text.length+1;
  document.getElementById("field_div").innerHTML=document.getElementById("field_div").innerHTML+
  "<p id='howLong"+total_text+"_wrapper'><input type='text' class='howLong' name='startTime' id='howLong"+total_text+"' placeholder='Kui kaua seade töötab'><input type='button' value='Remove' onclick=remove_field('howLong"+total_text+"');></p>";
}

function whatTime(){
  var total_text=document.getElementsByClassName("whatTime");
  total_text=total_text.length+1;
  document.getElementById("field_div").innerHTML=document.getElementById("field_div").innerHTML+
  "<p id='whatTime"+total_text+"_wrapper'><input type='text' class='whatTime' name='stopTime' id='whatTime"+total_text+"' placeholder='Mis kellast, mis kellani'><input type='button' value='Remove' onclick=remove_field('whatTime"+total_text+"');></p>";
}

function remove_field(id){
  document.getElementById(id+"_wrapper").innerHTML="";
}