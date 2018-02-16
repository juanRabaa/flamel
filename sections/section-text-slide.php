<?php
/*
*
*	Front page section template - Section text slide
*
*
*/
?>
<section id="section-text-slide">
	<div class="section-content container">
		<div class="text-slider" id="text-slider-landing">
			<div class="slider-header row">
				<div class="two columns">
					<h5 class="slider-title"><?php echo get_theme_mod('section-text-slide-title', 'MINDSET'); ?></h5>
				</div>
				<div class="ten columns slider-buttons">
					<?php 
						$texts = json_decode(get_theme_mod('section-text-slide-content', []), true);
						$index = 1;
						foreach( $texts as $text ):
							$class = "";
							if ( $index == 1 )
								$class = "active-button";
						?>
							<span slide-id="<?php echo $index; ?>" class="<?php echo $class; ?>"></span>
						<?php
							$index++;
						endforeach;
					?>
				</div>
			</div>
			<div class="slide-content">
				<p class="active-slide wow slideInRight"></p>
				<p class="hidden-slide"></p>
			</div>
		</div>
	</div>
	<?php get_template_part( "sections/content", "separator" ); ?>
</section>