function cssreload() {	
	$("link").each(function() {
		if ($(this).attr("type").indexOf("css") > -1) {
			$(this).attr("href", $(this).attr("href") + "?id=" + new Date().getMilliseconds());
		}
	});
}
		
$(document).ready(function(){

	if( localStorage.theme )
		$('link#theme').attr('href', localStorage.getItem("theme"));
	else{
		$('link#theme').attr('href', 'css/jupiter.css');
	}

$('#Jupiter').click(function(){
		document.getElementById("theme").setAttribute('href', "css/jupiter.css");
		localStorage.setItem("theme","css/jupiter.css");
	})
$('#Red').click(function(){
		document.getElementById("theme").setAttribute('href', "css/Red.css");
		localStorage.setItem("theme","css/Red.css");
	})
$('#oldskool').click(function(){
		document.getElementById("theme").setAttribute('href', "css/oldskool.css");
		localStorage.setItem("theme","css/oldskool.css");
	})	
$('#Dream').click(function(){
		document.getElementById("theme").setAttribute('href', "css/Dream.css");
		localStorage.setItem("theme","css/Dream.css");
	})
$('#Nature').click(function(){
		document.getElementById("theme").setAttribute('href', "css/Nature.css");
		localStorage.setItem("theme","css/Nature.css");
	})
$('#Gold').click(function(){
	document.getElementById("theme").setAttribute('href', "css/Gold.css");
	localStorage.setItem("theme","css/Gold.css");
})
$('#Sky').click(function(){
	document.getElementById("theme").setAttribute('href', "css/Sky.css");
	localStorage.setItem("theme","css/Sky.css");
})
$('#Last').click(function(){
	document.getElementById("theme").setAttribute('href', "css/Last.css");
	localStorage.setItem("theme","css/Last.css");
})
});


function generate_orarend() {
	var i=1;
	var time;
	var nap,ora;
	var mezotext;
	while(document.getElementById("i"+i))
	{
		time = document.getElementById("i"+i).innerHTML;
		if(time.includes("Hétfő")) nap = "h";
		else if(time.includes("Kedd")) nap = "k";
		else if(time.includes("Szerda")) nap = "sz";
		else if(time.includes("Csütörtök")) nap = "cs";
		else if(time.includes("Péntek")) nap = "p";
		
		if(time.includes(" 8")) ora = "8";
		else if(time.includes(" 9")) ora = "9";
		else if(time.includes("10")) ora = "10";
		else if(time.includes("11")) ora = "11";
		else if(time.includes("12")) ora = "12";
		else if(time.includes("13")) ora = "13";
		else if(time.includes("14")) ora = "14";
		else if(time.includes("15")) ora = "15";
		else if(time.includes("16")) ora = "16";
		else if(time.includes("17")) ora = "17";
		else if(time.includes("18")) ora = "18";
		else if(time.includes("19")) ora = "19";
		else if(time.includes("20")) ora = "20";
		mezotext = document.createElement("Span");
		mezotext.className = "orarend-span";
		mezotext.innerHTML = (document.getElementById("n"+i).innerHTML) + "<br>" + (document.getElementById("h"+i).innerHTML);
		document.getElementById(nap + "-" + ora).appendChild(mezotext);
		i++;
	}
	cssreload();
}