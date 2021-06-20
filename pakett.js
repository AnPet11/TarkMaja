function fikseerimata() {

	var valik1 = document.getElementById("valik1");
	var bors = document.getElementById("borsihinnad");
	var box1 = document.getElementById("box1");
	var box2 = document.getElementById("box2");
	var box3 = document.getElementById("box3");
	var box4 = document.getElementById("box4");
	
	if (valik1.checked == true){

	bors.style.display = "none";
	box1.style.display = "block";
	box2.style.display = "block";
	box3.style.display = "block";
	box4.style.display = "none";
	
	} 
}

function fikseeritud(){
	
	var valik2 = document.getElementById("valik2");
	var bors = document.getElementById("borsihinnad");
	var box1 = document.getElementById("box1");
	var box2 = document.getElementById("box2");
	var box3 = document.getElementById("box3");
	var box4 = document.getElementById("box4");
	
	if (valik2.checked == true){

	bors.style.display = "none";
	box1.style.display = "none";
	box2.style.display = "none";
	box3.style.display = "block";
	box4.style.display = "block";
	}
}

function borsihind(){
	
	var valik3 = document.getElementById("valik3");
	var bors = document.getElementById("borsihinnad");
	var box1 = document.getElementById("box1");
	var box2 = document.getElementById("box2");
	var box3 = document.getElementById("box3");
	var box4 = document.getElementById("box4");
	
	if (valik3.checked == true){
		
	bors.style.display = "block";
	box1.style.display = "none";
	box2.style.display = "none";
	box3.style.display = "none";
	box4.style.display = "none";
	}
}
