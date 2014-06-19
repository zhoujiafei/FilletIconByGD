<?php
/**
 * 生成圆角图标类
 */
class FilletIcon
{
	private $bgColor;//定义背景色
	private $fgColor;//定义前景色
	private $bgImage;//定义背景图
	private $fgImage;//定义前景图
	private $text;//定义图标上面的文字
	private $bgEffects;//定义背景图特效实际就是一张图
	private $iconWidth;//定义生成的图标的宽度
	private $iconHeight;//定义生成的图标的高度
	private $radius;//定义圆角的角度值
	private $font;//定义字体
	public function __construct($attr = array())
	{
		//初始化
		$this->init();
		//设置用户自定义的属性
		if(!empty($attr))
		{
			foreach ($this->getAttrNames() AS $name)
			{
				if(isset($attr[$name]) && $attr[$name])
				{
					if(in_array($name, array('bgColor','fgColor')))
					{
						$this->$name = $this->colorHxToRGB($attr[$name]);
					}
					else if($name == 'font')
					{
						$fontPath = dirname(__FILE__) . '/font/' . $attr[$name];
						if(!file_exists($fontPath))
						{
							continue;
						}
						$this->$name = $fontPath;
					}
					else 
					{
						$this->$name = $attr[$name];
					}
				}
			}
		}
	}

	//初始化,设置一些默认值
	private function init()
	{
		$this->bgColor = $this->colorHxToRGB('#FFA142');
		$this->fgColor = $this->colorHxToRGB('#FFFFFF');
		$this->iconWidth = $this->iconHeight = 200;
		$this->radius = 30;
		$this->font = dirname(__FILE__) . '/font/pavilion.ttf';//默认兰亭黑简
	}
	
	//属性列表
	private function getAttrNames()
	{
		return array('bgColor','fgColor','bgImage','fgImage','text','bgEffects','iconWidth','iconHeight','radius','font');
	}
	
	/**
	 * 将16进制颜色值分解成RGB
	 * 例如：0xff0000 => array('r' => 255,'g' => 0,'b' => 0);
	 */
	private function colorHxToRGB($hexColor)
	{
		$color = str_replace('#', '', (string)$hexColor);
		if (strlen($color) > 3)
		{
			$rgb = array(
				'r' => hexdec(substr($color, 0, 2)),
				'g' => hexdec(substr($color, 2, 2)),
				'b' => hexdec(substr($color, 4, 2)),
			);
		}
		else 
		{
			$r = substr($color, 0, 1) . substr($color, 0, 1);
			$g = substr($color, 1, 1) . substr($color, 1, 1);
			$b = substr($color, 2, 1) . substr($color, 2, 1);
			$rgb = array(
				'r' => hexdec($r),
				'g' => hexdec($g),
				'b' => hexdec($b)
			);
		}
		return $rgb;
	}
	
	/**
	 * 生成圆角
	 * 这些圆角实际上通过在一个小正方形上画弧线得来的
	 */
	private function createRounderCorner()
	{
		$img 		= imagecreatetruecolor($this->radius, $this->radius);// 创建一个正方形的图像
		$bgcolor 	= imagecolorallocate($img, 0, 0, 0);// 图像的背景
		$fgcolor 	= imagecolorallocate($img, $this->bgColor['r'], $this->bgColor['g'], $this->bgColor['b']);
		imagefill($img, 0, 0, $bgcolor);
		imagefilledarc($img, $this->radius, $this->radius, $this->radius * 2, $this->radius * 2, 180, 270, $fgcolor, IMG_ARC_PIE);
		//将弧角图片的颜色设置为透明
		imagecolortransparent($img, $bgcolor);
		return $img;
	}
	
	/**
	 *创建长方形 
	 */
	private function createRectangle($width,$height)
	{
		$img = imagecreatetruecolor($width, $height);
		$bgColor = imagecolorallocate($img, $this->bgColor['r'], $this->bgColor['g'], $this->bgColor['b']);//定义颜色
		imagefill($img, 0, 0, $bgColor);
		return $img;
	}
	
	
	//生成图标
	public function create()
	{
		//创建画布(图片优先)
		if($this->bgImage && file_exists($this->bgImage))
		{
			//以图片作为画布
			$resource = imagecreatefromjpeg($this->bgImage);
			$new_res  = imagecreate($this->iconWidth, $this->iconHeight);
			list($oWidth, $oheight) = getimagesize($this->bgImage);//获取原图片的宽度与高度
			imagecopyresampled($new_res, $resource, 0, 0, 0, 0, $this->iconWidth, $this->iconHeight, $oWidth, $oWidth);
			$resource = $new_res;
			
			header('Content-Type: image/png');
			imagepng($resource);
			exit;

		}
		else 
		{
			/*************************************创建一块真彩画布*************************************/
			$resource	 = imagecreatetruecolor($this->iconWidth, $this->iconHeight);//创建一个正方形的图像
			$bgcolor	 = imagecolorallocate($resource, 0, 0, 0); //图像的背景
			imagecolortransparent($resource, $bgcolor);//设置为透明
			imagefill($resource, 0, 0, $bgcolor);//填充颜色
			/*************************************创建一块真彩画布*************************************/
			
			/***************************分别在正方形的四个边角画圆角,然后合成到画布上************************/
			//左上角
			$ltCorner = $this->createRounderCorner();
			imagecopymerge($resource, $ltCorner, 0, 0, 0, 0, $this->radius, $this->radius, 100);
			
			//左下角
			$lbCorner	= imagerotate($ltCorner, 90, 0);
			imagecopymerge($resource, $lbCorner, 0, $this->iconHeight - $this->radius, 0, 0, $this->radius, $this->radius, 100);
			
			//右上角
			$rbCorner	= imagerotate($ltCorner, 180, 0);
			imagecopymerge($resource, $rbCorner, $this->iconWidth - $this->radius, $this->iconHeight - $this->radius, 0, 0, $this->radius, $this->radius, 100);
			
			//右下角
			$rtCorner	= imagerotate($ltCorner, 270, 0);
			imagecopymerge($resource, $rtCorner, $this->iconWidth - $this->radius, 0, 0, 0, $this->radius, $this->radius, 100);
			
			/***************************分别在正方形的四个边角画圆角,然后合成到画布上************************/
			
			/****************************************创建一个长方形,竖直的******************************/
			$rectWidth1 = $this->iconWidth - $this->radius * 2;
			$rectHeight1 = $this->iconHeight;
			$rect1 = $this->createRectangle($rectWidth1,$rectHeight1);
			imagecopymerge($resource, $rect1, $this->radius, 0, 0, 0, $rectWidth1, $rectHeight1, 100);
			/****************************************创建一个长方形,竖直的******************************/
			
			/****************************************创建一个长方形,横向的******************************/
			$rectWidth2 = $this->iconWidth;
			$rectHeight2 = $this->iconHeight - $this->radius * 2;
			$rect2 = $this->createRectangle($rectWidth2,$rectHeight2);
			imagecopymerge($resource, $rect2, 0, $this->radius, 0, 0, $rectWidth2, $rectHeight2, 100);
			/****************************************创建一个长方形,横向的******************************/
			
			/****************************************增加水印文字*************************************/
			$textColor = imagecolorallocate($resource,255,255,255);
			$textSize = 60;//字体大小
			$fontarea = imagettfbbox($textSize,0,$this->font,$this->text);
			$textWidth = $fontarea[2] - $fontarea[0];
			$textHeight = $fontarea[1] - $fontarea[7];
			$textX = $this->iconWidth/2 - $textWidth/2;
			$textY = $this->iconHeight/2 + $textSize/2;
			imagettftext($resource, $textSize, 0, $textX, $textY, $textColor, $this->font,$this->text);
			/****************************************增加水印文字*************************************/

			/**********************************************输出**************************************/
			header('Content-Type: image/png');
			imagepng($resource);
			exit;
			/**********************************************输出**************************************/
		}
	}
}
