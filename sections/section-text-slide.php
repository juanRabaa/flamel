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
					<h5 class="slider-title">MINDSET</h5>
				</div>
				<div class="ten columns slider-buttons">
					<span slide-id="1" class="active-button"></span>
					<span slide-id="2"></span>
					<span slide-id="3"></span>
				</div>
			</div>
			<div class="slide-content">
				<p class="active-slide wow slideInRight">Nuestro diferencial esta puesto en el pensamiento estrategico anclado en el pensamiento visual"</p>
				<p class="hidden-slide">Nuestro diferencial esta puesto en el pensamiento estrategico anclado en el pensamiento visual"</p>
			</div>
		</div>
	</div>
	<?php get_template_part( "sections/content", "separator" ); ?>
</section>