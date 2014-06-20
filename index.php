<?php
require_once('FilletIconByGD.php');

$icon = new FilletIcon(array(
	'text' => '龙',
	'radius' => 25,
	'iconWidth' => 140,
	'iconHeight' => 140,
	'bgImage' => 'http://img3.cache.netease.com/photo/0008/2014-06-20/9V5TL7QK5BD20008.jpg',
	'fgImage' => 'images/2.jpg',
	'rate' => 0.5,
));

$icon->create();


