<?php
require_once('FilletIconByGD.php');

$icon = new FilletIcon(array(
	'text' => '龙',
	'radius' => 0,
	'iconWidth' => 1024,
	'iconHeight' => 1024,
	'bgImage' => 'images/1.jpg',
	'fgImage' => 'images/4.jpg',
	'rate' 	=> 0.618,
	'gradualMode' => 'vertical',
	'textSize' => 600,
));

$icon->create();


