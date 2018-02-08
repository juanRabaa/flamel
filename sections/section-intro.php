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
		<img data-wow-delay="1s" class="wow bounceInUp" src="<?php echo get_theme_mod("section-intro-image")?>" id="intro-image">
		<div data-wow-delay="2s" class="wow fadeInUp" id="intro-text">
			<h6><?php echo get_theme_mod("section-intro-title",__("Welcome to my website", "flamel-genosha")); ?></h6>
		</div>
	</div>
</section>