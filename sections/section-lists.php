<?php
/*
*
*	Front page section template - Section lists
*
*
*/
$show_section = get_theme_mod('section-lists-show', true);
$visibility_class = "";
if ( !$show_section )
	$visibility_class = "display-none-section";
?>
<section id="section-lists" class="<?php echo $visibility_class; ?>">
	<?php if ($show_section): ?>
	<div class="section-content container">
		<?php
		$lists = json_decode ( get_theme_mod('section-lists-generator'), true );
		$delay = 0;
		foreach( $lists as $list_id => $list ):
			$list_name = $list["name"];
			$list_items = $list["items"];
			?>
			<div data-wow-duration="1s" data-wow-delay="<?php echo $delay; ?>s" class="list-container wow fadeInDown" id="<?php echo $list_id ?>">
				<h6 class="list-title"><?php echo $list_name ?></h6>
				<ul>
				<?php foreach( $list_items as $item ): ?>
					<li><?php echo $item ?></li>
				<?php endforeach; ?>
				</ul>
			</div>
			<?php $delay += 0.5; ?>
		<?php endforeach; ?>
	</div>
	<?php 
	if( get_theme_mod('section-lists-separator-show', true) ): 
		$image_src = get_theme_mod('section-lists-separator-image', "");
		$post_id = get_theme_mod('section-lists-separator-post', -1);
		$use_thumbnail = get_theme_mod('section-lists-separator-use-thumbnail', true);
		if ( $use_thumbnail && $post_id != -1 )
			$image_src = get_the_post_thumbnail_url($post_id,'full');
	?>
	<div class="section-separator" style="background-image: url('<?php echo $image_src; ?>');">
		<?php
			$title = get_theme_mod('section-lists-separator-text', "");
			$post_permalink = get_permalink(get_theme_mod('section-lists-separator-post', -1));
			
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