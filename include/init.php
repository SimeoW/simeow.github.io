<?php
date_default_timezone_set("America/Denver");

$lines=file('include/check.php');
$today=trim(date("F j, Y, g:i a"));
$dateToday=new DateTime($today);

$lastDate=new DateTime($lines[1]);
$dateDiff=$lastDate->diff($dateToday);
$minuteDiff=$dateDiff->days*24*60;
$minuteDiff+=$dateDiff->h*60;
$minuteDiff+=$dateDiff->i;

if($minuteDiff>=5){ //get a wallpaper every few minutes
	require 'BingPhoto.php';
	copy($image,'include/background.jpg');
	$lines[1]=$today."\n";
}

$lastDate=new DateTime($lines[4]);
$dateDiff=$lastDate->diff($dateToday);
$minuteDiff=$dateDiff->days*24*60;
$minuteDiff+=$dateDiff->h*60;
$minuteDiff+=$dateDiff->i;

if($minuteDiff>=1440){
	$lines[4]=$today."\n";
	$lines[7]=0;
}
$lines[7]++;

file_put_contents('include/check.php',implode("",$lines));

echo str_repeat('`',floor($lines[7]/1000));
echo str_repeat(',',floor($lines[7]%1000/100));
echo str_repeat('.',round($lines[7]%1000%100/10));
?>