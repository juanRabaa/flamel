<?php
/*
*
*	Front page section template - Section Intro
*
*
*/
?>
<section id="section-intro">
	<div class="section-content container">
		<div data-wow-delay="1s" data-wow-duration="1s"  class="intro-images-container wow bounceInUp">
			<img class="intro-image-mobile" src="<?php echo get_theme_mod("section-intro-image")?>" >
			<img class="intro-image-desktop" src="<?php echo get_theme_mod("section-intro-image-desktop")?>">
		</div>
		<div data-wow-delay="2s" data-wow-duration="1s" class="wow fadeInUp" id="intro-text">
			<p><?php echo get_theme_mod("section-intro-title",__("Welcome to my website", "flamel-genosha")); ?></p>
		</div>
	</div>
</section>