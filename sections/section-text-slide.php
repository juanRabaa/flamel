<?php
/*
*
*	Front page section template - Section text slide
*
*
*/
$show_section = get_theme_mod('section-text-slide-show', true);
$visibility_class = "";
if ( !$show_section )
	$visibility_class = "display-none-section";

$separator_post_id = get_theme_mod('section-text-slide-post', -1);

?>
<section id="section-text-slide" class="<?php echo $visibility_class; ?>">
	<?php if ($show_section): ?>
		<div class="section-content container">
			<div class="text-slider" id="text-slider-landing">
				<div class="slider-header row">
					<div class="section-title-column two columns">
						<h5 class="slider-title section-title"><?php echo get_theme_mod('section-text-slide-title', 'MINDSET'); ?></h5>
					</div>
					<div class="nine columns slider-buttons">
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
					<div class="one columns count-down">
						<span style="color: #fd2a5f;"></span>
					</div>				
				</div>
				<div class="slide-content">
					<p class="active-slide wow slideInRight"></p>
					<p class="hidden-slide"></p>
				</div>
			</div>
		</div>
		<?php 
		$section_separator_info = json_decode(get_theme_mod('section-text-slide-separator-info'), true);
		
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