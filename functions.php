<?php
add_theme_support( 'post-thumbnails' );

function load_styles() {
	wp_enqueue_style( "nanami-light", get_template_directory_uri()."/css/fonts/Nanami-Light.otf", array() );
	wp_enqueue_style( "TradeGothicforNike365-BdCn", get_template_directory_uri()."/css/fonts/TradeGothicforNike365-BdCn.ttf", array() );
	wp_enqueue_style( "normalize-skeleton-css", get_template_directory_uri()."/css/libs/Skeleton-2.0.4/css/normalize.css", array() );	
	wp_enqueue_style( "skeleton-css", get_template_directory_uri()."/css/libs/Skeleton-2.0.4/css/skeleton.css", array() );
	wp_enqueue_style( "font-awesome-css", get_template_directory_uri()."/css/libs/fontawesome-free-5.0.6/web-fonts-with-css/css/fontawesome-all.min.css", array() );
	wp_enqueue_style( "animate-css", get_template_directory_uri()."/css/libs/animate.css", array() );
}
add_action ("wp_enqueue_scripts", "load_styles");

function load_scripts() {
	wp_enqueue_script( "jquery-3", "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js", true );
	wp_enqueue_script( "wow", get_template_directory_uri()."/js/libs/wow.min.js", true );
	if (is_front_page()){
		$text_slider_data = array(
			'texts'				=> get_theme_mod('section-text-slide-content', '{}'),
			'slideDuration'		=> intval( get_theme_mod('section-text-slide-duration', 4000) ),
		);		
		wp_enqueue_script( 'landing-scripts', get_template_directory_uri()."/js/src/landing-scripts.js", true );
		wp_localize_script( 'landing-scripts', 'text_slider_data', $text_slider_data );
	}
}
add_action ("wp_enqueue_scripts", "load_scripts");

function load_styles_customizer() {	
	wp_enqueue_style( "skeleton-css", get_template_directory_uri()."/css/libs/Skeleton-2.0.4/css/skeleton.css", array() );
	wp_enqueue_style( "font-awesome-css", get_template_directory_uri()."/css/libs/fontawesome-free-5.0.6/web-fonts-with-css/css/fontawesome-all.min.css", array() );		
	wp_enqueue_style( "customizer-css", get_template_directory_uri()."/css/src/customizer.css" );
	wp_enqueue_style( "customizer-image-selection-control", get_template_directory_uri()."/css/src/customizer-image-selection-control.css" );
	wp_enqueue_style( "customizer-color-scheme-control", get_template_directory_uri()."/css/src/customizer-color-scheme-control.css" );
	wp_enqueue_style( "customizer-sortable-list-control", get_template_directory_uri()."/css/src/customizer-sortable-list-control.css" );
	wp_enqueue_style( "customizer-lists-generator-control", get_template_directory_uri()."/css/src/customizer-lists-generator-control.css" );
	wp_enqueue_style( "customizer-textarea-generator-control", get_template_directory_uri()."/css/src/customizer-textarea-generator-control.css" );
	wp_enqueue_style( "customizer-multiple-inputs-control", get_template_directory_uri()."/css/src/customizer-multiple-inputs-control.css" );
	wp_enqueue_style( "customizer-image-gallery-control", get_template_directory_uri()."/css/src/customizer-image-gallery-control.css" );
}
add_action( 'customize_controls_enqueue_scripts', 'load_styles_customizer' );	

function load_script_customizer() {
		//wp_enqueue_script( 'jquery-sortable', get_template_directory_uri() . '/js/libs/jquery-sortable.js', array( 'jquery' ), rand(), true );
		wp_enqueue_script( "jquery-ui", "https://code.jquery.com/ui/1.10.3/jquery-ui.js", array("jquery"), true );
		wp_enqueue_script( 'wp-editor-customizer', get_template_directory_uri() . '/js/src/customizer-panel.js', array( 'jquery' ), rand(), true );
		wp_enqueue_script( "customizer-image-selection-control", get_template_directory_uri()."/js/src/customizer-image-selection-control.js", array("jquery"), true );
		wp_enqueue_script( "customizer-sortable-list-control", get_template_directory_uri()."/js/src/customizer-sortable-list-control.js", array("jquery"), true );
		wp_enqueue_script( "customizer-lists-generator", get_template_directory_uri()."/js/src/customizer-lists-generator.js", array("jquery"), true );
		wp_enqueue_script( "customizer-multiple-inputs-control", get_template_directory_uri()."/js/src/customizer-multiple-inputs-control.js", array("jquery"), true );
		wp_enqueue_script( "customizer-image-gallery-control", get_template_directory_uri()."/js/src/customizer-image-gallery-control.js", array("jquery"), true );
}
add_action( 'customize_controls_enqueue_scripts', 'load_script_customizer' );

require 'customizer.php';

function get_sections_order(){
	return explode(',', get_theme_mod('sections-order'));
}

function load_frontpage_sections(){
	$sections_order = get_sections_order();
	?>
	<div id="main-sections">
	<?php
	get_template_part( "sections/section", "intro" );
	foreach( $sections_order as $section_sufix ){
		get_template_part( "sections/section", $section_sufix );
	}
	?>
	</div>
	<?php
}
