<?php
/*
*
*	Front page section template - Section tools
*
*
*/
$show_section = get_theme_mod('section-tools-show', true);
$visibility_class = "";
if ( !$show_section )
	$visibility_class = "display-none-section";
?>
<section id="section-tools" class="<?php echo $visibility_class; ?>">
	<?php if ($show_section): ?>
		<div class="section-content container">
			<?php
				$images_url = json_decode(get_theme_mod('section-tools-images', []));
			?>
			<h5 id="section-tools-title" class="section-title"><?php echo get_theme_mod('section-tools-title', 'Herramientas') ?></h5>
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
		<?php
		$section_separator_info = json_decode(get_theme_mod('section-tools-separator-info'), true);

		if( $section_separator_info['separator_show'] ):
			$image_src = $section_separator_info['separator_image'];
			$post_id = $section_separator_info['separator_post'] ? $section_separator_info['separator_post'] : -1;
			$use_thumbnail = $section_separator_info['separator_use_thumbnail'];
			if ( $use_thumbnail && $post_id != -1 )
				$image_src = get_the_post_thumbnail_url($post_id,'full');
		?>
		<div class="section-separator" style="background-image: url('<?php echo $image_src; ?>');">
		</div>
		<?php
			$title = $section_separator_info['separator_link_text'];
			$post_permalink = get_permalink($post_id);

			if( !empty($title) && !empty($post_permalink) ):
		?>
		<div class="separator-link">
			<h6>
			<?php
				$title_length = strlen($title);
				if ( $title_length > 80)
					$title = mb_strimwidth($title, 0, 83, "...");
				echo $title;
			?>
			</h6>
			<i class="fa fa-angle-right"></i>
			<a href="<?php echo $post_permalink; ?>"></a>
		</div>
		<?php endif; ?>
		<?php endif; ?>
	<?php endif; ?>
</section>
