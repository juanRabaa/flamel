<?php
/*
 * 
 * 
*/
get_header();
?>
<body>
    <div data-wow-duration="1s" id="navbar" class="wow fadeInDown">
		<div class="row">
			<div class="three columns" id="navbar-logo">
				<div id="logo-svg">
					<?php get_template_part( "svg", "logo" ); ?>
				</div>
			</div>
			<div id="navbar-menu" class="nine columns">
				<ul id="header-navigation-menu" class="page-navigation-list">
					<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-367 current-menu-item page_item current_page_item"><a href="#section-intro">HOLA</a></li>
					<li class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-382"><a href="#section-projects">TRABAJOS</a></li>
					<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-446"><a href="#section-authors">HABLEMOS</a></li>
				</ul>
			</div>
		</div>
	</div>
	<?php load_frontpage_sections(); ?>
	
<?php get_footer(); ?>

