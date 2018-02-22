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
			for ( $i = 1; $i <= 2; $i ++):
				$author_data = json_decode(get_theme_mod('section-authors-author-'.$i.'-data'),true);
				$author_image = get_theme_mod('section-authors-author-'.$i.'-image');
				
				if ( $i % 2 ):
			?>
		<div class="author-box-landing">
			<div data-wow-duration="1s" data-wow-delay="0.5s" class="author-description wow fadeInUp">
				<h5 class="author-name"><?php echo $author_data['author_name']; ?></h5>
				<h5 class="author-ocupation"><?php echo $author_data['author_ocupation']; ?></h5>
				<h6 class="author-email"><?php echo $author_data['author_email']; ?></h6>
			</div>
			<div data-wow-duration="1s" data-wow-delay="0s" class="author-photo wow fadeInDown" style="background-image: url('<?php echo $author_image; ?>');">
			</div>
		</div>
		<?php
				else:
		?>		
		<div class="author-box-landing">
			<div data-wow-duration="1s" data-wow-delay="0s" class="author-photo wow fadeInDown" style="background-image: url('<?php echo $author_image; ?>');">
			</div>							
			<div data-wow-duration="1s" data-wow-delay="0.5s" class="author-description wow fadeInUp">
				<h5 class="author-name"><?php echo $author_data['author_name']; ?></h5>
				<h5 class="author-ocupation"><?php echo $author_data['author_ocupation']; ?></h5>
				<h6 class="author-email"><?php echo $author_data['author_email']; ?></h6>	
			</div>			
		</div>
		<?php 
				endif; 
			endfor;
		?>
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