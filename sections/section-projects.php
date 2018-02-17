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
	<?php endif; ?>
</section>