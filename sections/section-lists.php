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
	<?php endif; ?>
</section>