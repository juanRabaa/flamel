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
	<?php endif; ?>
</section>