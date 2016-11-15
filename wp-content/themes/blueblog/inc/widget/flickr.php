<?php
/*
Author: Matheus Bratfisch
Author URI: http://www.matbra.com
*/

class FlickrWidget extends WP_Widget {

	private $flickr_api_key = "d348e6e1216a46f2a4c9e28f93d75a48";
	
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'FlickrWidget', // Base ID
			'Flickr Widget', // Name
			array( 'description' => __( 'Display Flickr Images', 'text_domain' ), ) // Args
		);
		wp_enqueue_script('thickbox', null,  array('jquery'));
		wp_enqueue_style('thickbox.css', '/'.WPINC.'/js/thickbox/thickbox.css', null, '1.0');
	}

	
	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		$this->generateFrontEnd($args, $instance);
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['username'] = strip_tags($new_instance['username']);
		$instance['view'] = strip_tags($new_instance['view']);
		$instance['before_item'] = $new_instance['before_item'];
		$instance['after_item'] = $new_instance['after_item'];
		$instance['before_widget'] = $new_instance['before_widget'];
		$instance['after_widget'] = $new_instance['after_widget'];
		$instance['items'] = intval($new_instance['items']);
		$instance['more_title'] = strip_tags($new_instance['more_title']);
		$instance['tags'] = strip_tags($new_instance['tags']);
		$instance['target'] = strip_tags($new_instance['target']);
		$instance['show_titles'] = strip_tags($new_instance['show_titles']);
		$instance['thickbox'] = strip_tags($new_instance['thickbox']);
		$instance['random'] = strip_tags($new_instance['random']);
		$instance['random_tag'] = strip_tags($new_instance['random_tag']);
		$instance['javascript'] = strip_tags($new_instance['javascript']);
		
		
		if (!empty($instance["username"]) && $instance["username"] != $old_instance["username"]) {
			if (!ereg("http://api.flickr.com/services/feeds", $instance["username"])) // Not a feed
			{
				$str = wp_remote_fopen("http://api.flickr.com/services/rest/?method=flickr.people.findByUsername&api_key=".$this->flickr_api_key."&username=".urlencode($instance["username"])."&format=rest");
				ereg("<rsp stat=\\\"([A-Za-z]+)\\\"", $str, $regs); $findByUsername["stat"] = $regs[1];

				if ($findByUsername["stat"] == "ok")
				{
					ereg("<username>(.+)</username>", $str, $regs);
					$findByUsername["username"] = $regs[1];
					
					ereg("<user id=\\\"(.+)\\\" nsid=\\\"(.+)\\\">", $str, $regs);
					$findByUsername["user"]["id"] = $regs[1];
					$findByUsername["user"]["nsid"] = $regs[2];
					
					$flickr_id = $findByUsername["user"]["nsid"];
					$newoptions["error"] = "";
				}
				else
				{
					$flickr_id = "";
					$newoptions["username"] = ""; // reset
					
					ereg("<err code=\\\"(.+)\\\" msg=\\\"(.+)\\\"", $str, $regs);
					$findByUsername["message"] = $regs[2] . "(" . $regs[1] . ")";
					
					$newoptions["error"] = "Flickr API call failed! (findByUsername returned: ".$findByUsername["message"].")";
				}
				$instance["user_id"] = $flickr_id;
			} else {
				$newoptions["error"] = "";
			}
		} else { 
			$instance["user_id"] = $old_instance["user_id"];
		}
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
			$title 			 	  = isset( $instance[ 'title' ] ) ? esc_attr( $instance[ 'title' ] ) : '';
			$username 	 	 	  = isset( $instance[ 'username' ] ) ? esc_attr( $instance[ 'username' ] ) : '';
			$view 			 	  = isset( $instance[ 'view' ] ) ? esc_attr( $instance[ 'view' ] ) : '';
			$items				  = isset( $instance[ 'items' ] ) ? esc_attr( $instance[ 'items' ] ) : '';
			$more_title 		  = isset( $instance[ 'more_title' ] ) ? esc_attr( $instance[ 'more_title' ] ) : '';
			$target 			  = isset( $instance[ 'target' ] ) ? esc_attr( $instance[ 'target' ] ) : '';
			$show_titles 		  = isset( $instance[ 'show_titles' ] ) ? esc_attr( $instance[ 'show_titles' ] ) : '';
			$thickbox 			  = isset( $instance[ 'thickbox' ] ) ? esc_attr( $instance[ 'thickbox' ] ) : '';
			$javascript 		  = isset( $instance[ 'javascript' ] ) ? esc_attr( $instance[ 'javascript' ] ) : '';
			

			
		?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr($title) ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id( 'username' ); ?>">Flickr RSS URL or Screen name: <input class="widefat" id="<?php echo $this->get_field_id( 'username' ); ?>" name="<?php echo $this->get_field_name( 'username' ); ?>" type="text" value="<?php echo esc_attr($username); ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id( 'view' ); ?>">Size: 
			<select class="widefat" id="<?php echo $this->get_field_id( 'view' ); ?>" name="<?php echo $this->get_field_name( 'view' ); ?>">
			<option value="_s" <?php ($view=="_s" ? "selected=\"selected\"" : "");?>>Square</option>
			<option value="_t" <?php ($view=="_t" ? "selected=\"selected\"" : "");?>>Thumbnail</option>
			<option value="_m" <?php ($view=="_m" ? "selected=\"selected\"" : "");?>>Small</option>
		</select>
		</label></p>

		<p><label for="<?php echo $this->get_field_id( 'items' ); ?>">How many items? <select class="widefat" id="<?php echo $this->get_field_id( 'items' ); ?>" name="<?php echo $this->get_field_name( 'items' ); ?>"><?php for ( $i = 1; $i <= 20; ++$i ) echo "<option value=\"$i\" ".($items==$i ? "selected=\"selected\"" : "").">$i</option>"; ?></select></label></p>
		<p><label for="<?php echo $this->get_field_id( 'target' ); ?>"><input id="<?php echo $this->get_field_id( 'target' ); ?>" name="<?php echo $this->get_field_name( 'target' ); ?>" type="checkbox" value="checked" <?php echo $target; ?> /> Target: _blank</label></p>
		<p><label for="<?php echo $this->get_field_id( 'thickbox' ); ?>"><input id="<?php echo $this->get_field_id( 'thickbox' ); ?>" name="<?php echo $this->get_field_name( 'thickbox' ); ?>" type="checkbox" value="checked" <?php echo $thickbox; ?> /> Use Thickbox</label></p>
	    <?php  /*<p><label for="<?php echo $this->get_field_id( 'javascript' ); ?>"><input id="<?php echo $this->get_field_id( 'javascript' ); ?>" name="<?php echo $this->get_field_name( 'javascript' ); ?>" type="checkbox" value="checked" <?php echo $javascript; ?> /> <?php _e("Use javascript (Careful here!)"); ?></label></p> --> */ ?>
		<?php 
	}
	private function retrieve_random_tag($flickrid, $maxcount=20) { 
        
		$params = array(
			'api_key'	=> $this->flickr_api_key,
			'method'	=> 'flickr.tags.getListUserPopular',
			'count'	=> $maxcount,
			'user_id'	=> $flickrid,
			'format'	=> 'php_serial',
		);	

		$encoded_params = array();

		// Loop through parameters and encode

		foreach ($params as $k => $v){

			// Encode parameters for the url of the API call

			$encoded_params[] = urlencode($k).'='.urlencode($v);

		}



		// Call the API and decode the response

		$url = "http://api.flickr.com/services/rest/?".implode('&', $encoded_params);		



		// Fetch the info

		$rsp = wp_remote_get($url);

		$rsp_obj = unserialize($rsp);

		$tags = $rsp_obj['who']['tags']['tag'];
		shuffle($tags);
		$tagNumber = rand(0,count($tags));
        return $tags[$tagNumber]['_content'];
	}
	
	private function generateFrontEnd($args, $instance) {
			extract($args);
				
			$title 			 	  = $instance[ 'title' ];
			$username 	 		  = $instance[ 'username' ];
			$view 			 	  = $instance[ 'view' ];
			$before_item 	 	  = $instance[ 'before_item' ];
			$after_item 	 	  = $instance[ 'after_item' ];
			$before_flickr_widget = $instance[ 'before_widget' ];
			$after_flickr_widget  = $instance[ 'after_widget' ];
			$items				  = $instance[ 'items' ];
			$more_title 		  = $instance[ 'more_title' ];
			$tags 				  = $instance[ 'tags' ];
			$target 			  = $instance[ 'target' ];
			$show_titles 		  = $instance[ 'show_titles' ];
			$thickbox 			  = $instance[ 'thickbox' ];
			$random 			  = $instance[ 'random' ];
			$randomTag 			  = $instance[ 'random_tag' ];
			$javascript 		  = $instance[ 'javascript' ];
			$user_id			  = $instance[ 'user_id' ];
				
			$target = ($target == "checked") ? "target=\"_blank\"" : "";
			$show_titles = ($show_titles == "checked") ? true : false;
			$thickbox = ($thickbox == "checked") ? true : false;
			$tags = (strlen($tags) > 0) ? "&tags=" . urlencode($tags) : "";
			$random = ($random == "checked") ? true : false;
			$randomTag = ($randomTag == "checked") ? true : false; 

			if($random == true && $randomTag == true) {
				$randomTagText = $this->retrieve_random_tag($user_id);
				$tags = "&tags=" . urlencode($randomTagText) . "&tagmode=any";
			}
			$javascript = ($javascript == "checked") ? true : false;
					
			if ($javascript) $flickrformat = "json"; else $flickrformat = "php_serial";
					
			if (empty($items) || $items < 1 || $items > 20) $items = 3;
					
			// Screen name or RSS in $username?
			if (!ereg("http://api.flickr.com/services/feeds", $username))
				$url = "http://api.flickr.com/services/feeds/photos_public.gne?id=".urlencode($user_id)."&format=".$flickrformat."&lang=en-us".$tags;
			else
				$url = $username."&format=".$flickrformat.$tags;
					
			// Output via php or javascript?
			if (!$javascript) {
						$photos = unserialize(wp_remote_fopen($url));
						if ($random) shuffle($photos["items"]);
						if ($photos)
						{
							$flickr_home = $photos["url"];
							foreach($photos["items"] as $key => $value)
							{
								if (--$items < 0) break;
								
								$photo_title = $value["title"];
								$photo_link = $value["url"];
								ereg("<img[^>]* src=\"([^\"]*)\"[^>]*>", $value["description"], $regs);
								$photo_url = $regs[1];
								$photo_description = str_replace("\n", "", strip_tags($value["description"]));
								
								//$photo_url = $value["media"]["m"];
								$photo_medium_url = str_replace("_m.jpg", ".jpg", $photo_url);
								$photo_url = str_replace("_m.jpg", "$view.jpg", $photo_url);
								
								$thickbox_attrib = ($thickbox) ? "class=\"thickbox\" title=\"\"" : "";
								$href = ($thickbox) ? $photo_medium_url : $photo_link;
								
								$photo_title = ($show_titles) ? "<div class=\"qflickr-title\">$photo_title</div>" : "";
								if (!isset($out)) $out = "";
								$out .= $before_item . "<div class=\"flickrwidget_box\"><a $thickbox_attrib $target href=\"$href\"><img class=\"flickr_photo\" alt=\"$photo_description\" src=\"$photo_url\" /></a></div>$photo_title" . $after_item; 
								}
						} else	{
							$out = "Something went wrong with the Flickr feed! Please check your configuration and make sure that the Flickr username or RSS feed exists";
						}			
					} else {
						$out = "<script type=\"text/javascript\" src=\"$url\"></script>";
					}
			?>
			
			<!-- Fast Flickr start -->
				<?php echo $before_widget.$before_flickr_widget; ?>
					<?php if(!empty($title)) { $title = apply_filters('localization', $title); echo $before_title . $title . $after_title; } ?>
					<?php echo $out ?>
					<?php if (!empty($more_title) && !$javascript) echo "<a href=\"" . strip_tags($flickr_home) . "\">$more_title</a>"; ?>
				<?php echo $after_flickr_widget.$after_widget; ?>
			<!-- Fast Flickr end -->
			
			<?php
	}

} // class Foo_Widget
add_action( 'widgets_init', create_function( '', 'register_widget( "FlickrWidget" );' ) );

?>