<?php
class dailyBoothWidget extends WP_Widget
{
	
	function dailyBoothWidget()
	{
		parent::WP_Widget(false, 'WP DailyBooth Widget');
	}
	
	function widget($args, $instance)
	{
		global $dailyBooth;
		
		extract($args);
		
		$title = $instance['title'];
    	$id = $instance['id'];
    	$images = $instance['images'];
    	$width = $instance['width'];
    	$height = $instance['height'];
    	$show_caption = isset($instance['show_caption']) ? 'true' : 'false';
    	
    	echo $before_widget;
    	echo $before_title . $title . $after_title;
    	echo $dailyBooth->images($id, $images, $width, $height, $show_caption);
    	echo $after_widget;
	}
	

	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['id'] = $new_instance['id'];
		$instance['width'] = $new_instance['width'];
		$instance['height'] = $new_instance['height'];
		$instance['show_caption'] = $new_instance['show_caption'];
		
		return $instance;
	}
	

	
	function form($instance)
	{
		$defaults = array('title' => 'DailyBooth Updates', 'id' => 'jon', 'images' => 3, 'width' => 50, 'height' => 50, 'show_caption' => false);
		$instance = wp_parse_args(array($instance), $defaults);
		
		if($instance[0]) { $instance = $instance[0]; }
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $instance['title']; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('id'); ?>"><?php _e('DailyBooth ID'); ?> <input class="widefat" id="<?php echo $this->get_field_id('id'); ?>" name="<?php echo $this->get_field_name('id'); ?>" type="text" value="<?php echo $instance['id']; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('images'); ?>"><?php _e('Images: (Max 10)'); ?> <input class="widefat" id="<?php echo $this->get_field_id('images'); ?>" name="<?php echo $this->get_field_name('images'); ?>" type="text" value="<?php echo $instance['images']; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('width'); ?>"><?php _e('Width'); ?> <input class="widefat" id="<?php echo $this->get_field_id('width'); ?>" name="<?php echo $this->get_field_name('width'); ?>" type="text" value="<?php echo $instance['width']; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('height'); ?>"><?php _e('Height'); ?> <input class="widefat" id="<?php echo $this->get_field_id('height'); ?>" name="<?php echo $this->get_field_name('height'); ?>" type="text" value="<?php echo $instance['height']; ?>" /></label></p>
		<p>
			<input class="checkbox" type="checkbox" <?php checked($instance['show_caption'], 'on'); ?> id="<?php echo $this->get_field_id('show_caption'); ?>" name="<?php echo $this->get_field_name('show_caption'); ?>" /> 
			<label for="<?php echo $this->get_field_id('show_caption'); ?>">Show caption</label>
		</p>
<?php
	}
  
}

add_action('widgets_init', create_function('', 'return register_widget("dailyBoothWidget");'));