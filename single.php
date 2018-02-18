<?php
/*
 * 
 * 
*/
get_header();
?>
<body>
	<div data-wow-duration="1s" id="navbar" class="post-navbar">
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
		<div class="post-fotter">
			<div class="container">
				<svg version="1.1" class="desktop-logo" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 575 110" enable-background="new 0 0 575 110" xml:space="preserve">
				<g>
				<path d="M505.5,66.6l4.5,4.5l4.5-4.5l-3.2-1.9v-7.1h5.8c0.8,9.2,8.1,16.6,17.4,17.3v5.8h-7.1l-1.9-3.2l-4.5,4.5l4.5,4.5l1.9-3h17.2
				l1.9,3l4.5-4.5l-4.5-4.5l-1.9,3.2h-7.1v-5.8c9.4-0.6,16.8-8,17.6-17.3h5.6v7.2l-3,1.9l4.5,4.5l4.5-4.5l-3.2-1.9v-17l3.2-1.9
				l-4.5-4.5l-4.5,4.5l3,1.9v7.2h-5.6c-0.6-9.4-8.2-17.1-17.6-17.7v-5.7h7.2l1.9,3l4.5-4.5l-4.5-4.5l-1.9,3.2h-17l-1.9-3.2l-4.5,4.5
				l4.5,4.5l1.9-3h7.2v5.7c-9.5,0.7-16.8,8.2-17.4,17.7h-5.7v-7.1l3.2-1.9l-4.5-4.5l-4.5,4.5l3,1.9v17.2L505.5,66.6z M534.5,57.6v14.5
				c-7.7-0.7-13.8-6.8-14.6-14.5H534.5z M534.5,39.9v14.9h-14.6C520.5,46.9,526.6,40.6,534.5,39.9z M537.3,54.8V39.8
				c7.9,0.6,14.2,7,14.8,14.9H537.3z M537.3,72.1V57.6h14.8C551.3,65.3,545.1,71.5,537.3,72.1z"></path>
				<polygon points="93.2,2.4 88.5,2.4 88.5,109.7 164.3,109.7 164.3,104.9 93.2,104.9 	"></polygon>
				<path d="M217.7,2.4l-48.7,106l-0.6,1.3h5.8L190,74.8h60.3l15.8,34.9h5.8L222.6,2.4H217.7z M248.2,70h-56l28-61.6L248.2,70z"></path>
				<polygon points="336.5,104.2 281.7,2.8 281.4,2.4 275.1,2.4 275.1,109.7 279.9,109.7 279.9,10.6 333.6,109.2 333.8,109.7 
				338.8,109.7 392.7,10.6 392.7,109.7 397.5,109.7 397.5,2.4 391.2,2.4 	"></polygon>
				<polygon points="498.5,104.9 498.5,2.4 493.8,2.4 493.8,109.7 569.6,109.7 569.6,104.9 	"></polygon>
				<path d="M434.6,7.3L434.6,7.3c-11.3,5.2-20.2,13.4-26.4,24.7c-4,8.9-6,17.1-6,24.4c0,5.8,1.4,12.7,4,20.5c1.7,4.3,4.7,9.2,9,14.6
				c11.7,12.2,25,18.4,39.6,18.4h31.3v-3.9h-27.3c-8.9,0-16-1.2-21.1-3.6c-8.7-3.3-16.2-9.3-22.3-17.7l0-0.1
				c-4.9-7.8-7.9-16.2-8.7-24.9l-0.1-0.8c0,0,0-0.1,0-0.1h54.8v-4.1h-54.8c0-0.2,0-0.4,0-0.6l0.6-4.1c1.2-8.3,4.3-15.8,9-22.4
				C426.8,14,440.4,7.2,456.6,7.2h29.5V2.8h-28.8C449.5,2.8,441.8,4.3,434.6,7.3z"></path>
				<path d="M37.2,5.4c-13.7,5-24.5,15.8-29.5,29.5c-2,5.5-3,11.2-3,17v57.8h4.8V74.9l0,0.1V56.2l66.8,0v-4.8H9.5
				C9.8,27.2,28.8,7.8,53,7.2l27.5-0.1V2.4H54.3C48.4,2.4,42.7,3.4,37.2,5.4z"></path>
				</g>
				</svg>
				<p class="container"><?php echo get_theme_mod("section-intro-title",__("Welcome to my website", "flamel-genosha")); ?></p>
			</div>
		</div>
	</div>
	
<?php get_footer(); ?>
