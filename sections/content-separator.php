<?php
/*
*
*	Separator for landing sections
*
*
*/
?>
<div class="section-separator" style="background-image: url('<?php echo get_template_directory_uri(); ?>/assets/img/water.png');">
	<div class="separator-link">
		<h6>
		<?php 
			$title = "Arte utilizado para el proyecto de Boca Juniors";
			$title_length = strlen($title);
			
			if ( $title_length > 80)
				$title = mb_strimwidth($title, 0, 83, "...");
			
			echo $title; ?>
		</h6>
		<i class="fa fa-angle-right"></i>
	</div>
</div>