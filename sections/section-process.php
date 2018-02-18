<?php
/*
*
*	Front page section template - Section process
*
*
*/
$show_section = get_theme_mod('section-process-show', true);
$visibility_class = "";
if ( !$show_section )
	$visibility_class = "display-none-section";
?>
<section id="section-process" class="<?php echo $visibility_class; ?>">
	<?php if ($show_section): ?>
	<div class="section-content container">
		<div class="process-mobile">
			<?php $section_title = get_theme_mod('section-process-title', __("PROCESO DE TRABAJO")); ?>
			<h6 class="process-section-title"><?php echo $section_title; ?></h6>    
			<div class="process-tree">
				<?php
				$lists = json_decode ( get_theme_mod('section-process-generator', '{}'), true );
				$lists_amount = count($lists);
				$counter = 1;
				foreach( $lists as $list_id => $list ):?>
					<div class="process">
						<?php
						$list_name = $list["name"];
						$list_items = $list["items"];					
						?>
						<div class="process-title">
							<span class="process-number"><?php echo $counter; ?></span>
							<span class="process-name"><?php echo $list_name; ?></span>
							<i class="open-process-button fa fa-plus-circle"></i>
						</div>
						<div class="process-items-container">
							<?php foreach( $list_items as $item ): ?>
							<div class="process-item-holder">
								<i class="fa fa-angle-right"></i>
								<span class="process-item"><?php echo $item; ?></span>
							</div>
							<?php endforeach; ?>
						</div>	
					</div>		
					<?php
					$counter++;
				endforeach;
				?>
			</div>
		</div>
		<div class="process-desktop">
			<h6 class="process-section-title"><?php echo $section_title; ?></h6>    
			<div class=" process-tree-desktop">
				<?php
				$counter = 1;
				foreach( $lists as $list_id => $list ):
					$list_name = $list["name"];
					$list_items = $list["items"];
					
					if ( $counter % 2 ):
				?>
					<div class="process">
						<div class="process-content">
							<div class="process-title">
								<span class="process-number"><?php echo $counter; ?></span>
								<span class="process-name"><?php echo $list_name; ?></span>
							</div>
							<div class="process-items-container">
								<?php foreach( $list_items as $item ): ?>
								<div class="process-item-holder">
									<i class="fa fa-angle-down"></i>
									<span class="process-item"><?php echo $item; ?></span>
								</div>
								<?php endforeach; ?>
							</div>
						</div>
						<?php if ( $lists_amount != $counter ): ?>
						<div class="process-arrow">
							<div class="arrow"></div>
							<div class="fixed-hidder"><div></div></div>					
						</div>
						<?php endif; ?>
					</div>
				<?php else: ?>
					<div class="process">
						<div class="process-arrow">
							<div class="even-arrow-container">
								<?php if ( $lists_amount != $counter ): ?>
								<div class="arrow-left"></div>
								<div class="fixed-hidder"><div></div></div>
								<?php endif; ?>
							</div>
						</div>
						<div class="process-content">
							<div class="process-title">
								<span class="process-number"><?php echo $counter; ?></span>
								<span class="process-name"><?php echo $list_name; ?></span>
							</div>
							<div class="process-items-container">
								<?php foreach( $list_items as $item ): ?>
								<div class="process-item-holder">
									<i class="fa fa-angle-down"></i>
									<span class="process-item"><?php echo $item; ?></span>
								</div>
								<?php endforeach; ?>
							</div>
						</div>
					</div>
				<?php endif;
				$counter++;
				endforeach;
				?>
			</div>
		</div>		
	</div>
	<?php 
	if( get_theme_mod('section-process-separator-show', true) ): 
		$image_src = get_theme_mod('section-process-separator-image', "");
		$post_id = get_theme_mod('section-process-separator-post', -1);
		$use_thumbnail = get_theme_mod('section-process-separator-use-thumbnail', true);
		if ( $use_thumbnail && $post_id != -1 )
			$image_src = get_the_post_thumbnail_url($post_id,'full');
	?>
	<div class="section-separator" style="background-image: url('<?php echo $image_src; ?>');">
		<?php
			$title = get_theme_mod('section-process-separator-text', "");
			$post_permalink = get_permalink(get_theme_mod('section-process-separator-post', -1));
			
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