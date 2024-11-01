<?php
/*
Plugin Name: WP-DailyBooth
Plugin URI: http://mharis.net/dailybooth-plugin-for-wordpress/
Description: Add <a href='http://dailybooth.com'>dailybooth</a> updates to your blog posts, pages and sidebar.
Author: Muhammad Haris - <a href='http://twitter.com/mharis'>@mharis</a> on twitter
Version: 1.0.3
Author URI: http://mharis.net
*/

$pluginURL = WP_PLUGIN_URL . '/wp-dailybooth';
$pluginPath = dirname(__FILE__);

class WP_DailyBooth
{	
	
	public function __construct()
	{
		
		add_shortcode('dailybooth', array($this, 'shortcode'));
		
	}
		
	public function getImages($id, $images = 3, $width = 50, $height = 50, $caption = false)
	{
		global $pluginPath, $pluginURL;
		
		$userID = json_decode(file_get_contents('http://api.dailybooth.com/v1/users.json?username='.$id));
		
		if($userID->user_id) {
			$dailyBooth = json_decode(file_get_contents('http://api.dailybooth.com/v1/users/'.$userID->user_id.'/pictures.json?limit='.$images));
			
			if($dailyBooth) {
				$imagesArray[] = '<ul class="dailybooth">';
				$count = 1;
				foreach ($dailyBooth as $dbImage) {
					if ($count <= $images) {
						$image = $dbImage->urls->large;
						
						$fileName = basename($image);
						
						if (!file_exists($pluginPath . '/full-images/' . $fileName)) {
							
							$rawImage = file_get_contents($image);
							$newImagePath = $pluginPath  . '/full-images/' . $fileName;
							$fp = fopen($newImagePath, 'x');
							fwrite($fp, $rawImage);
							fclose($fp);
							  
						}
						
						$localImage = $pluginURL . '/timthumb.php?src=' . strstr($pluginPath, 'wp-content') . '/full-images/' . $fileName . '&w=' . $width . '&h=' . $height . '&q=100';
						
						if($caption) {
							$captionHTML = '<p>'.$dbImage->blurb.'</p>';
						}
						
						$imagesArray[] = '<li><a href="http://dailybooth.com/' . $id . '/' . $dbImage->picture_id . '" title="' . $dbImage->title . '"><img src="' . $localImage . '" alt="' . $dbImage->title . '" /></a>'.$captionHTML.'</li>';
					} 
					$count++;
				}
				$imagesArray[] = '</ul>';
			}
			
			return implode("\n", $imagesArray);
		}
		
	}
	
	public function images($id, $images = 3, $width = 50, $height = 50, $caption = false)
	{
		echo $this->getImages($id, $images, $width, $height, $caption);	
	}
	
	public function shortcode($atts)
	{
		extract(shortcode_atts(array(
			'images' => 3,
			'width' => 50,
			'height' => 50,
			'caption' => false,
		), $atts));
		
		return $this->getImages($atts['id'], $images, $width, $height, $caption);
	}
	
}

require_once('wp-dailybooth-widget.php');

$dailyBooth = new WP_DailyBooth;