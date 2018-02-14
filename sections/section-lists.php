<?php
/*
*
*	Front page section template - Section lists
*
*
*/
?>
<section id="section-lists">
	<div class="section-content container">
		<?php
		$lists = json_decode ( get_theme_mod('section-lists-title'), true );
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
</section>