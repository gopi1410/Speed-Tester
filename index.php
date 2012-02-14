<html>
<head>
<title>Speed Tester</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="Gopi Ramena IIT Kanpur" />
<meta name="keywords" content="gopi, ramena, gopi ramena, student, student search iitk, student search, iit kanpur, iitk, developer, coder, programmer, web app developer" />
<script type="text/javascript" src="jquery.js"></script>

<script type="text/javascript">
var temp,browser;
var scount=0,running=1;
var colour=new Array();
colour['up']="red";
colour['left']="yellow";
colour['down']="blue";
colour['right']="green";


navigator.sayswho= (function(){
var N= navigator.appName, ua= navigator.userAgent, tem;
var M= ua.match(/(opera|chrome|safari|firefox|msie)\/?\s*(\.?\d+(\.\d+)*)/i);
if(M && (tem= ua.match(/version\/([\.\d]+)/i))!= null) M[2]= tem[1];
M= M? [M[1], M[2]]: [N, navigator.appVersion,'-?'];
browser=M[0];
})();
//alert(browser);

$(document).ready(function() {
	$("#startgame").click(function() {
		document.getElementById('startgame').disabled='true';
	});
	$("#up").click(function() {
		check(document.getElementById('up').style.background);
	});
	$("#left").click(function() {
		check(document.getElementById('left').style.background);
	});
	$("#down").click(function() {
		check(document.getElementById('down').style.background);
	});
	$("#right").click(function() {
		check(document.getElementById('right').style.background);
	});
	$(document).keypress(function(e) {
		if(e.keyCode==119) {
			check(document.getElementById('up').style.background);
		}
		if(e.keyCode==97) {
			check(document.getElementById('left').style.background);
		}
		if(e.keyCode==115) {
			check(document.getElementById('down').style.background);
		}
		if(e.keyCode==100) {
			check(document.getElementById('right').style.background);
		}
	});
	$(document).bind('keydown',function(evt) {
		switch(evt.keyCode) {
			case 37:
				check(document.getElementById('left').style.background);
				break;
			case 38:
				check(document.getElementById('up').style.background);
				break;
			case 39:
				check(document.getElementById('right').style.background);
				break;
			case 40:
				check(document.getElementById('down').style.background);
				break;
		}
	});
});

function clearall()
{
	document.getElementById('up').style.background="grey";
	document.getElementById('left').style.background="grey";
	document.getElementById('down').style.background="grey";
	document.getElementById('right').style.background="grey";
}

function generate()
{
	document.getElementById('up').style.background="grey";
	document.getElementById('left').style.background="grey";
	document.getElementById('down').style.background="grey";
	document.getElementById('right').style.background="grey";
	var arr=['up','left','down','right'];
	var rid=arr[Math.floor(Math.random()*arr.length)];
	document.getElementById(rid).style.background=colour[rid];
	if(scount!=0)
	{
		setTimeout('clearall()',800-(5*scount)-200);
		temp=setTimeout('generate()',800-(5*scount));
	}
	else
	{
		setTimeout('clearall()',1000);
		temp=setTimeout('generate()',1200);
	}
}

function check(col)
{
	if(col=="grey" && running==1)
	{
		document.getElementById('startgame').disabled=false;
		running=0;
		document.getElementById('up').style.background="red";
		document.getElementById('left').style.background="yellow";
		document.getElementById('down').style.background="blue";
		document.getElementById('right').style.background="green";
		clearTimeout(temp);
		setTimeout("disp(scount)",600);
	}
	else
	{
		if(running==1)
		{
			scount++;
			document.getElementById("score").innerHTML="Your Score: <b>"+scount+"<br/>";
		}
	}
}

function disp(c)
{
	submitscore();
}

function starter()
{	
	if(browser=="Chrome" || browser=="chrome")
	{
		scount=0;
		running=1;
		document.getElementById("score").innerHTML="Your Score: <b>0</b>";
		generate();
	}
	else
	{
		alert("Sorry this works only in Chrome");
	}
}

function gethighscore()
{
	document.getElementById('highscore').innerHTML="<b><font size='5'>Highscore:</font></b><br/><br/>";
	$.ajax({
	url: "query.php",
	success: function(response) {
		res=response.split("*****");
		//alert(res);
		document.getElementById('highscore').innerHTML+=res[0]+"&nbsp;&nbsp;&nbsp;"+res[1]+"<br/><br/>"+res[0]+"'s ip:"+res[2];
	}
	});
}

function submitscore()
{
	$.ajax({
	url: "query.php",
	success: function(response) {
		res=response.split("*****");
		//alert(res);
		if(res[1]<scount)
		{
			var name=prompt("You have made a high score.\nPlease enter your name (max 12 characters)","Gopi Ramena");
			$.ajax({
			type:"POST",
			data: {score:scount,user:name},
			url: "query.php",
			success: function(response) {
				//document.getElementById('highscore').innerHTML="<b>Highscore:</b><br/>";
				//res=response.split("*****");
				//alert(res);
				//document.getElementById('highscore').innerHTML+=res[0]+"&nbsp;&nbsp;&nbsp;"+res[1];
				window.location.reload();
			}
			});
		}
		else
		{
			alert("Better luck next time.. :)\nTry to beat "+res[0]);
		}
	}
	});
}
</script>

<style type="text/css">
.clickbut
{
	cursor:pointer;
	-moz-border-radius: 10px;
    -webkit-border-radius: 10px;
    border-radius: 10px;
    border: 1px solid;
}
#up
{
	position:fixed;
	top:35%;
	left:45%;
	background-color:red;
	width:6%;
	height:10%;
}
#left
{
	position:fixed;
	top:50%;
	left:35%;
	background-color:yellow;
	width:6%;
	height:10%;
}
#down
{
	position:fixed;
	top:50%;
	left:45%;
	background-color:blue;
	width:6%;
	height:10%;
}
#right
{
	position:fixed;
	top:50%;
	left:55%;
	background-color:green;
	width:6%;
	height:10%;
}
#strt
{
	position:fixed;
	top:70%;
	left:44%;
}
#score
{
	position:fixed;
	top:27%;
	left:45%;
}
#highscore
{
	position:fixed;
	top:30%;
	left:80%;
}
#footer
{
	position:fixed;
	bottom:5px;
	left:42%
}
</style>
</head>

<body onload="gethighscore()">
<div id="header" align="center">
<h1>Speed Tester</h1>
<p>(Click on the boxes when they glow or use the <b>arrow keys</b> or use the <b>W,A,S,D keys</b>)
<br/>(Beat the highscore &amp; your name will be in display. <b>PS: hackers, your score would be set to 0.. :P</b>)<br/>
(You must be using <b>Chrome</b>. Currently not developed for Firefox &amp; other browsers.)</p>
</div>

<div id="score" align="center">
Your Score: <b>0</b>
</div>

<div id="highscore" align="center">
Loading....
</div>

<div align="center">

<div id="up" class="clickbut">
</div>
<div id="left" class="clickbut">
</div>
<div id="down" class="clickbut">
</div>
<div id="right" class="clickbut">
</div>

</div>

<div align="center" id="strt">
<input type="button" id="startgame" value="START GAME!" onclick="starter()" />
</div>

<div id="footer">
<p>Developed by <a href="../index.php">Gopi Ramena</a></p>
<h4>&copy; 2012 | GOPI RAMENA</h4>
</div>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-28288340-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

</body>
</html>