<?php
require_once('FilletIconByGD.php');

$icon = new FilletIcon(array(
	//'text' => '加',
	'radius' => 0,
	'iconWidth' => 1024,
	'iconHeight' => 1024,
	'bgImage' => 'images/flat.png',
	//'fgImage' => 'images/76.png',
	'rate' 	=> 0.618,
	'gradualMode' => 'vertical',
	'textSize' => 480,
	//'font' => 'fangzheng.ttf',
));

$icon->create();


