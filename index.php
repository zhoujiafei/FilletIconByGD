<?php
require_once('FilletIconByGD.php');

//http://www.zc520.cc/php/103.html

$icon = new FilletIcon(array(
	'text' => '龙',
	'radius' => 30,
	'iconWidth' => 128,
	'iconHeight' => 128,
	'bgImage' => 'images/4.jpg',
	'fgImage' => 'images/5.png',
	'rate' 	=> 0.618,
	'gradualMode' => 1,
));

$icon->create();


