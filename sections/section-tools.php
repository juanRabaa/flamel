<?php
/*
*
*	Front page section template - Section tools
*
*
*/
?>
<section id="section-tools">
	<div class="section-content container">
		<?php
			$images_id = get_theme_mod('section-tools-images', []); 
			$images_url = array_map("wp_get_attachment_url", $images_id);
		?>
		<h5 id="section-tools-title">HERRAMIENTAS</h5>
		<div id="section-tools-images">
		<?php 
			$delay = 0;
			foreach( $images_url as $image_url ):
				?>
				<div><img data-wow-duration="1.5s" data-wow-delay="<?php echo $delay; ?>s" class="wow fadeInUp" src="<?php echo $image_url; ?>"/></div>
				<?php
				$delay += 0.3;
			endforeach;
		?>
		</div>
	</div>
	<?php get_template_part( "sections/content", "separator" ); ?>
</section>