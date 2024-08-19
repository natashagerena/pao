<?php

// Load core files
require_once('core/bootstrap.php');

// Remove categories and tags
add_action('init', 'vex_remove_tax');
function vex_remove_tax()
{
    register_taxonomy('post_tag', []);
}

// Remove content from home
add_action('admin_init', 'hide_editor');
function hide_editor()
{
    $postId = $_GET['post'] ? $_GET['post'] : $_POST['post_ID'];

    if (isset($postId) && $postId == 2) {
        remove_post_type_support('page', 'editor');
    }
}

// Disable image compression
add_filter('jpeg_quality', function () {
    return 100;
});
add_filter('wp_editor_set_quality', function () {
    return 100;
});

// Add data to Timber context
add_filter('timber_context', 'vex_add_to_context');
function vex_add_to_context($data)
{
    global $post;

    $data['meta'] = [
        'title'       => get_field('meta_title', $post->ID) ?: get_bloginfo('name'),
        'description' => get_field('meta_description', $post->ID) ?: get_field('meta_description', 'option'),
        'image'       => get_field('meta_image', $post->ID) ?: get_field('meta_imagem', 'option'),
    ];

    $data['google_maps_key'] = GOOGLE_MAPS_API_KEY;

    return $data;
}

/**
 * get_youtube_thumb($id_video)
 * @return string
 */
function get_youtube_thumb($id_video) {
	$url = $id_video;
	parse_str( parse_url( $url, PHP_URL_QUERY ), $my_array_of_vars );
	$id_video = $my_array_of_vars['v'];

	if (@getimagesize("https://img.youtube.com/vi/$id_video/maxresdefault.jpg")) {
		$thumb = "https://img.youtube.com/vi/$id_video/maxresdefault.jpg";
	} else if(@getimagesize("https://img.youtube.com/vi/$id_video/hqdefault.jpg")) {
		$thumb = "https://img.youtube.com/vi/$id_video/hqdefault.jpg";
	} else if(@getimagesize("https://img.youtube.com/vi/$id_video/sddefault.jpg")) {
		$thumb = "https://img.youtube.com/vi/$id_video/sddefault.jpg";
	} else if(@getimagesize("https://img.youtube.com/vi/$id_video/mqdefault.jpg")) {
		$thumb = "https://img.youtube.com/vi/$id_video/mqdefault.jpg";
	} else {
		$thumb = "https://img.youtube.com/vi/$id_video/default.jpg";
	}

	return $thumb;
}
