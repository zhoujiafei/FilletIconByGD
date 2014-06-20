<?php
require_once('FilletIconByGD.php');

$icon = new FilletIcon(array(
	'text' => '龙',
	'radius' => 25,
	'iconWidth' => 140,
	'iconHeight' => 140,
	'bgImage' => 'images/2.jpg',
	'fgImage' => 'images/1.jpg',
	'rate' => 0.5,
));

$icon->create();


