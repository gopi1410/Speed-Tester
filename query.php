<?php

$ip=$_SERVER["REMOTE_ADDR"];
if(isset($_POST['score']) && isset($_POST['user']))
{
	$n=substr($_POST['user'],0,12);
	if(((int)$_POST['score'])>100)
		$score=0;
	else
		$score=$_POST['score'];
	$n=" ".strtolower($n);
	$file=fopen("girlfriend.txt","w") or die("Error opening database!");
	if(strpos($n,'gopi') || strpos($n,'lund') || strpos($n,'baap') || strpos($n,'chod') || strpos($n,'sex') || strpos($n,'chut') || strpos($n,'maa')  || strpos($n,'*') || strpos($n,'fuck') || strpos($n,'behen') || strpos($n,'chud'))
	{
		$n="Guest";
		$str=$n."*****".$score."*****".$ip;
		fwrite($file,$str);
		sleep(0.5);
	}
	else
	{
		$str=trim($n)."*****".$score."*****".$ip;
		fwrite($file,$str);
		sleep(0.5);
	}
}
else
{
	$file=fopen("girlfriend.txt","r") or die("Error opening database!");
	echo fgets($file);
}
fclose($file);

?>
