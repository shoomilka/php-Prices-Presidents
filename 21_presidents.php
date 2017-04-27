<?php

/*
По адресу http://2eu.kiev.ua/presidents.csv можно получить CSV файл со списком президентов.
Нужно вывести год, в котором было живо наибольшее количество президентов.
*/

$handle = fopen('http://2eu.kiev.ua/presidents.csv', 'r');

fgets($handle);

$presidents = array();

while($line = fgets($handle)){
	array_push($presidents, explode(',', $line));
}

fclose($handle);

$firstPresidentBDay = 2017;
$lastPresidentBDay = 0;

foreach($presidents as $president){
	if($president[2] < $firstPresidentBDay) $firstPresidentBDay = $president[2];
	if($president[2] > $lastPresidentBDay) $lastPresidentBDay = $president[2];
}

$year = 0;
$maxPresidentsCount = 0;

for($i = $firstPresidentBDay; $i <= $lastPresidentBDay; $i++){
	$currentPresidentsCount = 0;
	foreach($presidents as $president){
		if(($president[2] <= $i) && (($president[4] >= $i)||($president[4] == ''))) $currentPresidentsCount++;
	}
	if($currentPresidentsCount > $maxPresidentsCount){
		$maxPresidentsCount = $currentPresidentsCount;
		$year = $i;
	}
}

$years = array();

for($i = $year; $i <= $lastPresidentBDay; $i++){
	$currentPresidentsCount = 0;
	foreach($presidents as $president){
		if(($president[2] <= $i) && (($president[4] >= $i)||($president[4] == ''))) $currentPresidentsCount++;
	}
	if($currentPresidentsCount == $maxPresidentsCount){
		array_push($years, $i);
	}
}

echo '<pre>';
var_dump($years);
echo '</pre>';