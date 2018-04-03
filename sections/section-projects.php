<?php
/*
*
*	Front page section template - Section projects
*
*
*/
$show_section = get_theme_mod('section-projects-show', true);
$visibility_class = "";
if ( !$show_section )
	$visibility_class = "display-none-section";
?>
<section id="section-projects" class="<?php echo $visibility_class; ?>">
	<?php 
	if ($show_section): 
		$args = array( 
			'tag_id'			=> get_theme_mod('section-projects-tag', ''),
			'post_type'			=> 'post',
			'posts_per_page' 	=> get_theme_mod('section-projects-amount', 3),
		);
		$wp_query = new WP_Query( $args );
		$delay = 0;
	?>
		<div class="container">
			<div class="shadows-holder">
				<div class="shadow-right-holder">
					<div class="shadow-right"></div>
					<div class="shadow-right-bottom"></div>
					<div class="shadow-right-top"></div>
				</div>		
				<div class="shadow-left-holder">
					<div class="shadow-left"></div>
					<div class="shadow-left-bottom"></div>
					<div class="shadow-left-top"></div>
				</div>
			</div>
		</div>
		<div class="section-content container">
			<div class="projects-slides-container" id="projects-slider">
				<?php 
				while($wp_query->have_posts()): 
					$wp_query->the_post();
				?>
				<div data-wow-duration="1s" data-wow-delay="<?php echo $delay; ?>s" class="project-slide wow fadeInUp">
					<div class="project-image">
						<div style="background-image: url('<?php echo get_the_post_thumbnail_url(null,'full'); ?>');"></div>
					</div>
					<h6 class="project-category"><?php echo get_the_category()[0]->name; ?></h6>
					<span class="project-name"><?php the_title(); ?></span>
					<a href="<?php the_permalink(); ?>"></a>
				</div>
				<?php 
					$delay += 0.3;
						if ( $delay == 3 )
							break;
					endwhile; 
				//wp_reset_query();
				?>
			</div>		
		</div>
		<?php 
		$section_separator_info = json_decode(get_theme_mod('section-projects-separator-info'), true);
		
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