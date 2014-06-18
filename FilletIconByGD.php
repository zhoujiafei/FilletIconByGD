<?php
	/** 圆角
	$radius	 = 100;
	$img	 = imagecreatetruecolor($radius, $radius);	// 创建一个正方形的图像
	$bgcolor	= imagecolorallocate($img, 223, 0, 0);	 // 图像的背景
	$fgcolor	= imagecolorallocate($img, 0, 0, 0);
	imagefill($img, 0, 0, $bgcolor);
	// $radius,$radius：以图像的右下角开始画弧
	// $radius*2, $radius*2：已宽度、高度画弧
	// 180, 270：指定了角度的起始和结束点
	// fgcolor：指定颜色
	imagefilledarc($img, $radius, $radius, $radius*2, $radius*2, 180, 270, $fgcolor, IMG_ARC_PIE);
	// 将弧角图片的颜色设置为透明
	imagecolortransparent($img, $fgcolor);
	// 变换角度
	// $img	= imagerotate($img, 90, 0);
	// $img	= imagerotate($img, 180, 0);
	// $img	= imagerotate($img, 270, 0);
	header('Content-Type: image/png');
	imagepng($img);
	**/
	
	function get_lt_rounder_corner($radius) {
		$img	 = imagecreatetruecolor($radius, $radius);	// 创建一个正方形的图像
		$bgcolor	= imagecolorallocate($img, 223, 0, 0);	 // 图像的背景
		$fgcolor	= imagecolorallocate($img, 255, 0, 255);
		imagefill($img, 0, 0, $bgcolor);
		// $radius,$radius：以图像的右下角开始画弧
		// $radius*2, $radius*2：已宽度、高度画弧
		// 180, 270：指定了角度的起始和结束点
		// fgcolor：指定颜色
		imagefilledarc($img, $radius, $radius, $radius*2, $radius*2, 180, 270, $fgcolor, IMG_ARC_PIE);
		// 将弧角图片的颜色设置为透明
		imagecolortransparent($img, $bgcolor);
		// 变换角度
		// $img	= imagerotate($img, 90, 0);
		// $img	= imagerotate($img, 180, 0);
		// $img	= imagerotate($img, 270, 0);
		// header('Content-Type: image/png');
		// imagepng($img);
		return $img;
	}

	$image_width	= 300;
	$image_height	= 300;
	$resource	 = imagecreatetruecolor($image_width, $image_height);	// 创建一个正方形的图像
	$bgcolor	 = imagecolorallocate($resource, 223, 223, 0);	 // 图像的背景
	imagecolortransparent($resource, $bgcolor);
	imagefill($resource, 0, 0, $bgcolor);

	// 圆角处理
	$radius	 = 60;
	// lt(左上角)
	$lt_corner	= get_lt_rounder_corner($radius);
	imagecopymerge($resource, $lt_corner, 0, 0, 0, 0, $radius, $radius, 100);
	// lb(左下角)
	$lb_corner	= imagerotate($lt_corner, 90, 0);
	imagecopymerge($resource, $lb_corner, 0, $image_height - $radius, 0, 0, $radius, $radius, 100);
	// rb(右上角)
	$rb_corner	= imagerotate($lt_corner, 180, 0);
	imagecopymerge($resource, $rb_corner, $image_width - $radius, $image_height - $radius, 0, 0, $radius, $radius, 100);
	// rt(右下角)
	$rt_corner	= imagerotate($lt_corner, 270, 0);
	imagecopymerge($resource, $rt_corner, $image_width - $radius, 0, 0, 0, $radius, $radius, 100);
	
	//创建一个长方形,竖直的
	$_img_w1 = $image_width - 2 * $radius;
	$_img_h1 = $image_height;
	$_img_s1 = imagecreatetruecolor($_img_w1, $_img_h1);
	$_img_bgcolor1 = imagecolorallocate($_img_s1, 255, 0, 255);//定义颜色
	imagefill($_img_s1, 0, 0, $_img_bgcolor1);
	//叠加
	imagecopymerge($resource, $_img_s1, $radius, 0, 0, 0, $_img_w1, $_img_h1, 100);
	
	//创建一个长方形,横向的
	$_img_w2 = $image_width;
	$_img_h2 = $image_height - 2 * $radius;
	$_img_s2 = imagecreatetruecolor($_img_w2, $_img_h2);
	$_img_bgcolor2 = imagecolorallocate($_img_s2, 255, 0, 255);//定义颜色
	imagefill($_img_s2, 0, 0, $_img_bgcolor2);
	
	//叠加
	imagecopymerge($resource, $_img_s2, 0, $radius, 0, 0, $_img_w2, $_img_h2, 100);

	header('Content-Type: image/png');
	imagepng($resource);
	exit;
?>