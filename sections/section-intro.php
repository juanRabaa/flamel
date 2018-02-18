<?php
/*
*
*	Front page section template - Section Intro
*
*
*/
$show_section = get_theme_mod('section-intro-show', true);
$visibility_class = "";
if ( !$show_section )
	$visibility_class = "display-none-section";
?>
<section id="section-intro" class="<?php echo $visibility_class; ?>">
	<?php if ($show_section): ?>
	<div class="section-content container">
		<div data-wow-delay="1s" data-wow-duration="1s"  class="intro-images-container wow fadeInUp">
			<img class="intro-image-mobile" src="<?php echo get_theme_mod("section-intro-image")?>" >
			<img class="intro-image-desktop" src="<?php echo get_theme_mod("section-intro-image-desktop")?>">
		</div>
		<div data-wow-delay="2s" data-wow-duration="1s" class="wow fadeInUp" id="intro-text">
			<p><?php echo get_theme_mod("section-intro-title",__("Welcome to my website", "flamel-genosha")); ?></p>
		</div>
	</div>
	<?php 
	if( get_theme_mod('section-intro-separator-show', true) ): 
		$image_src = get_theme_mod('section-intro-separator-image', "");
		$post_id = get_theme_mod('section-intro-separator-post', -1);
		$use_thumbnail = get_theme_mod('section-intro-separator-use-thumbnail', true);
		if ( $use_thumbnail && $post_id != -1 )
			$image_src = get_the_post_thumbnail_url($post_id,'full');
	?>
	<div class="section-separator" style="background-image: url('<?php echo $image_src; ?>');">
		<?php
			$title = get_theme_mod('section-intro-separator-text', "");
			$post_permalink = get_permalink(get_theme_mod('section-intro-separator-post', -1));
			
			if( !empty($title) && !empty($post_permalink) ):
		?>
		<div class="separator-link">
			<h6>
			<?php 
				$title_length = strlen($title);
				
				if ( $title_length > 80)
					$title = mb_strimwidth($title, 0, 83, "...");
				
				echo $title; ?>
			</h6>
			<i class="fa fa-angle-right"></i>
			<a href="<?php echo $post_permalink; ?>"></a> 
		</div>
		<?php endif; ?>
	</div>
	<?php endif; ?>	
	<?php endif; ?>
</section>