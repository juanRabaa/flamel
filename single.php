<?php
/*
 * 
 * 
*/
get_header();
?>
<body>
	<div data-wow-duration="1s" id="navbar" class="post-navbar">
		<div class="container">
			<div class="row">
				<div class="navbar-title-post">			
					<i class="fas fa-chevron-left"></i>
					<span class="title-text-navbar">VOLVER A TRABAJOS</span>
				</div>
				<div id="logo-svg">
					<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 62 62" enable-background="new 0 0 62 62" xml:space="preserve">
					<path d="M0.5,41.6L5,46.1l4.5-4.5l-3.2-1.9v-7.1h5.8c0.8,9.2,8.1,16.6,17.4,17.3v5.8h-7.1l-1.9-3.2L15.9,57l4.5,4.5l1.9-3h17.2
					l1.9,3l4.5-4.5l-4.5-4.5l-1.9,3.2h-7.1v-5.8c9.4-0.6,16.8-8,17.6-17.3h5.6v7.2l-3,1.9l4.5,4.5l4.5-4.5l-3.2-1.9v-17l3.2-1.9L57,16.2
					l-4.5,4.5l3,1.9v7.2h-5.6c-0.6-9.4-8.2-17.1-17.6-17.7V6.4h7.2l1.9,3l4.5-4.5l-4.5-4.5l-1.9,3.2h-17l-1.9-3.2l-4.5,4.5l4.5,4.5
					l1.9-3h7.2v5.7c-9.5,0.7-16.8,8.2-17.4,17.7H6.4v-7.1l3.2-1.9L5,16.2l-4.5,4.5l3,1.9v17.2L0.5,41.6z M29.5,32.6v14.5
					c-7.7-0.7-13.8-6.8-14.6-14.5H29.5z M29.5,14.9v14.9H14.9C15.5,21.9,21.6,15.6,29.5,14.9z M32.3,29.8V14.8c7.9,0.6,14.2,7,14.8,14.9
					H32.3z M32.3,47.1V32.6h14.8C46.3,40.3,40.1,46.5,32.3,47.1z"></path>
					</svg>
				</div>
				<a href="<?php echo get_home_url(); ?>"></a>
			</div>
		</div>
	</div>
	<div id="main-content">
		<?php while ( have_posts() ) : the_post(); ?>
		<div class="post-header">
			<div class="container">
				<span class="post-category"><?php echo get_the_category()[0]->name; ?></span>
				<p class="post-title"><?php the_title(); ?></p>
				<p class="post-excerpt"><?php echo get_the_excerpt(); ?></p>
				<?php 
					$cliente = get_post_meta(  $post->ID, 'cliente', true );
					if( !empty($cliente) ):
				?>
				<span class="post-client"><?php echo $cliente; ?></span>
				<?php endif; ?>
			</div>
		</div>
		<?php 
			$thumbnail_url = get_the_post_thumbnail_url(null,'full');
			if ( $thumbnail_url ) :
		?>		
		<div class="image-separator" style="background-image: url('<?php echo $thumbnail_url; ?>');"></div>
		<?php endif; ?>
		<div class="post-content">
			<div class="container">
				<?php the_content(); ?> 
			</div>
		</div>
		<?php endwhile; ?>
	</div>
	
<?php get_footer(); ?>
