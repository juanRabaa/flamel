<?php
function load_styles() {
	wp_enqueue_style( "nanami-light", get_template_directory_uri()."/css/fonts/Nanami-Light.otf", array() );
	wp_enqueue_style( "TradeGothicforNike365-BdCn", get_template_directory_uri()."/css/fonts/TradeGothicforNike365-BdCn.ttf", array() );
	wp_enqueue_style( "normalize-skeleton-css", get_template_directory_uri()."/css/libs/Skeleton-2.0.4/css/normalize.css", array() );	
	wp_enqueue_style( "skeleton-css", get_template_directory_uri()."/css/libs/Skeleton-2.0.4/css/skeleton.css", array() );
	wp_enqueue_style( "font-awesome-css", get_template_directory_uri()."/css/libs/font-awesome-4.7.0/css/font-awesome.min.css", array() );
}
add_action ("wp_enqueue_scripts", "load_styles");

function load_scripts() {
	wp_enqueue_script( "jquery-3", "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js", true );
	wp_enqueue_script( "colors-functions", get_template_directory_uri()."/js/src/color-functions.js", true );
	wp_enqueue_script( "anime-js", get_template_directory_uri()."/js/libs/anime-master/anime.min.js", true );
	wp_enqueue_script( "dynamics", get_template_directory_uri()."/js/libs/dynamics.min.js", true );
}
add_action ("wp_enqueue_scripts", "load_scripts");