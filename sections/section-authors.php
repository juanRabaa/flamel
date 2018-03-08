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
			<?php
				$authors_info = json_decode(get_theme_mod( 'section-authors-info' ), true);
				if ( !empty ($authors_info) ):
					$counter = 1;
					foreach ( $authors_info as $author_data ):			
						?>
					<div class="author-box-holder">
						<div class="author-box-landing">
							<?php if ( !($counter % 2) ): ?>
							<div data-wow-duration="1s" data-wow-delay="0s" class="author-photo wow fadeInDown" style="background-image: url('<?php echo $author_data['author_pic']; ?>');">
							</div>
							<?php endif; ?>
							<div data-wow-duration="1s" data-wow-delay="0.5s" class="author-description wow fadeInUp">
								<h5 class="author-name"><?php echo $author_data['author_name']; ?></h5>
								<h5 class="author-ocupation"><?php echo $author_data['author_ocupation']; ?></h5>
								<h6 class="author-email"><?php echo $author_data['author_mail']; ?></h6>
							</div>
							<?php if ( ($counter % 2) ): ?>
							<div data-wow-duration="1s" data-wow-delay="0s" class="author-photo wow fadeInDown" style="background-image: url('<?php echo $author_data['author_pic']; ?>');">
							</div>
							<?php endif; ?>
						</div>
						<div data-wow-duration="1s" data-wow-delay="0.5s" class="author-box-bio wow fadeInUp"><?php echo $author_data['author_bio']; ?></div>
					</div>
					<?php
						$counter++;
					endforeach;
				endif;
			?>
		</div>
		<?php 
		$section_separator_info = json_decode(get_theme_mod('section-authors-separator-info'), true);
		
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