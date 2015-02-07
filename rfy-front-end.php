<?php

add_action("wp_head" , "rfy_header");

function rfy_header() {

}
$rfy_settings = get_option("rfy_settings");
if ($rfy_settings["enabled"] == 'yes') {
	add_filter("the_content" , "rfy_content");
}
function rfy_content($content) {

	if(is_single()) {

		$current_post 	= get_the_ID();
		$post_id 		= get_recomended_post_for($current_post);
		$featured_img 	= get_the_post_thumbnail( $post_id );
		$title 			= get_the_title( $post_id );
		$my_post 		= get_post( $post_id ); 
		$excerpt 		= $my_post->post_excerpt;
		$excerpt		= preg_replace("/<img[^>]+\>/i", "", $excerpt); 
		$url 			= get_permalink($post_id);

		if(empty($excerpt)) {
			
			$excerpt 	= get_post_field( "post_content", $post_id );
			//get only 20 words
			$excerpt 	= trim(strip_tags($excerpt));
			$excerpt	= preg_replace("/<img[^>]+\>/i", "", $excerpt); 
			$excerpt 	= implode(' ', array_slice(explode(' ', $excerpt), 0, 20));

		}
		$rfy_settings = get_option("rfy_settings");
		if ($rfy_settings["enabled_btn"] == 'yes') {
			$close_btn = "<div class='rf_close_btn'><a>X</a></div>";
		}else{
			$close_btn = "";
		}
		$addmore .= "<div class='rf_end_of_content'></div>";
		$addmore .= "<div class='rf_floating' id='rf_".get_the_ID()."'>";
		$addmore .= "<div class='rf_heading' > <h3>Recommended For You.</h3> </div>";
		$addmore .= "<div class='rf_title' > <a href='$url' class='rfy_a'>$title</a> </div>";
		$addmore .= "<div class='rf_img' >  $featured_img </div>";
		$addmore .= "<div class='rf_content'> $excerpt </div>";
		$addmore .= $close_btn;
		$addmore .= "</div>";

		$content .= $addmore;

	}
	
	return $content;

}

function get_recomended_post_for($current_post) {

	$tags 			= wp_get_post_tags( $current_post );
	if ($tags) {
			
		$current_tag 	= $tags[0]->slug;
		$the_query		= new WP_Query( array( 'tag' => $current_tag, 'posts_per_page' => '1', 'post__not_in' => array($current_post) ) );

		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$post_id = get_the_ID();	
			}
		}else{
			$post_id = get_random_posts_for($current_post);
		}

	}else{
		$post_id = get_random_posts_for($current_post);
	}
	return $post_id;
}

function get_random_posts_for($current_post){
	$posts_count 	= rand(1,15);
	$the_query		= new WP_Query( array( 'posts_per_page' => $posts_count, 'post__not_in' => array($current_post) ) );
	if ( $the_query->have_posts() ) {
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$post_id = get_the_ID();	
		}
	}

	return $post_id;
}