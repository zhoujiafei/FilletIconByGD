<?php
require_once('FilletIconByGD.php');

//http://www.zc520.cc/php/103.html

$icon = new FilletIcon(array(
	'text' => '龙',
	'radius' => 30,
	'iconWidth' => 128,
	'iconHeight' => 128,
	'bgImage' => 'http://img3.cache.netease.com/photo/0008/2014-06-20/9V5TL7QK5BD20008.jpg',
	'fgImage' => 'http://10.0.1.40/applant/app_icon/icon/model_icon_add.png',
	'rate' 	=> 0.618,
));

$icon->create();


