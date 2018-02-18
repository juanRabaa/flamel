<?php
/*
*
*	Front page section template - Section authors
*
*
*/
$show_section = get_theme_mod('section-authors-show', true);
$visibility_class = "";
if ( !$show_section )
	$visibility_class = "display-none-section";
?>
<section id="section-authors" class="<?php echo $visibility_class; ?>">
	<?php if ($show_section): ?>
	<div class="section-content container">
		<div class="author-box-landing">
			<div data-wow-duration="1s" data-wow-delay="0.5s" class="author-description wow fadeInUp">
				<h5 class="author-name">SOLEDAD RIVAS</h5>
				<h5 class="author-ocupation">MANAGIN DIRECTOR</h5>
				<h6 class="author-email">soledad@flamel.biz</h6>
			</div>
			<div data-wow-duration="1s" data-wow-delay="0s" class="author-photo wow fadeInDown" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/author-1.png');">
			</div>
		</div>
		<div class="author-box-landing">
			<div data-wow-duration="1s" data-wow-delay="0s" class="author-photo wow fadeInDown" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/author-2.png');">
			</div>							
			<div data-wow-duration="1s" data-wow-delay="0.5s" class="author-description wow fadeInUp">
				<h5 class="author-name">GUSTAVO CHIOCCIONI</h5>
				<h5 class="author-ocupation">DESIGN DIRECTOR</h5>
				<h6 class="author-email">gustavo@flamel.biz</h6>	
			</div>			
		</div>
	</div>
	<?php 
	if( get_theme_mod('section-authors-separator-show', true) ): 
		$image_src = get_theme_mod('section-authors-separator-image', "");
		$post_id = get_theme_mod('section-authors-separator-post', -1);
		$use_thumbnail = get_theme_mod('section-authors-separator-use-thumbnail', true);
		if ( $use_thumbnail && $post_id != -1 )
			$image_src = get_the_post_thumbnail_url($post_id,'full');
	?>
	<div class="section-separator" style="background-image: url('<?php echo $image_src; ?>');">
		<?php
			$title = get_theme_mod('section-authors-separator-text', "");
			$post_permalink = get_permalink(get_theme_mod('section-authors-separator-post', -1));
			
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