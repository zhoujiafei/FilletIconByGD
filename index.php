<?php
require_once('FilletIconByGD.php');

$icon = new FilletIcon(array(
	'text' => '龙',
	'radius' => 0,
<<<<<<< HEAD
	'iconWidth' => 1024,
	'iconHeight' => 1024,
	'bgImage' => 'images/1.jpg',
	'fgImage' => 'images/4.jpg',
=======
	'iconWidth' => 128,
	'iconHeight' => 128,
	'bgImage' => 'images/5.png',
	'fgImage' => 'images/model_icon_discover.png',
>>>>>>> FETCH_HEAD
	'rate' 	=> 0.618,
	'gradualMode' => 'vertical',
	'textSize' => 600,
));

$icon->create();


