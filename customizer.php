<?php	
function mutant_customizer_register_settings( $wp_customize ) {

	require get_template_directory() . '/inc/customizer-controls.php';
	require get_template_directory() . '/inc/customizer-settings.php';


	function create_setting ( $manager, $id, $default = '' ){
		$manager->add_setting(
			$id,
			array(
				'transport' => 'postMessage',
				'default'	=> $default,
			)
		);
		return $id;
	}
	
	//Category list used in customizer 
	function get_category_list_array(){
		$category_array = array();
		$categories = get_categories( array(
			'orderby' => 'name',
			'order'   => 'ASC',
			'fields'  => 'names',
			'get' 	  => 'all'
		) );
		$cont = 0;
		foreach($categories as $cat) {
		  $category_array[$cont] = esc_html( $cat );
		  $cont++;
		}
		return $category_array;		
	}
	
	$category_list = get_category_list_array();
    
	$wp_customize->get_section( 'title_tagline')->priority = 1;
	//data structs that estructuras de datos que guardan la informacion de las opciones y controles segun seccion para poder
	//for selective refresh
	$datos_selective_refresh = array(
		'logo' => array(
			'id' => 'logo',
			'selector' => '.logo-anchor',
			'settings' => array(
			),
			'render_callback' => function(){
				load_logo("header-logo");
			}    
		),

		'sections-order' => array(
			'id' => 'sections-order',
			'selector' => '#main-sections',
			'settings' => array(
			),
			'render_callback' => function(){
				load_frontpage_sections();
			}
		),

		'section-intro' => array(
			'id' => 'section-intro',
			'selector' => '#section-intro',
			'settings' => array(
			),
			'render_callback' => function(){
				get_template_part( "sections/section", "intro" );
			}
		),	
		
		'section-lists' => array(
			'id' => 'section-lists',
			'selector' => '#section-lists',
			'settings' => array(
			),
			'render_callback' => function(){
				get_template_part( "sections/section", "lists" );
			}
		),		
		
	);	
	
/*Sections panel
*************************************************************************************************************************/
$wp_customize->add_panel( 'front_page_panel', array(
	'priority'       => 3,
	'capability'     => 'edit_theme_options',
	'theme_supports' => '',
	'title'          => __('Front page', 'entity-power-design'),
	'description'    => __('Front page settings', 'entity-power-design'),
) );

/*Sections order
*************************************************************************************************************************/	
	
	$wp_customize->add_section(
		'sections-order',
		array(
			'title'     => 'Sections order',
			'priority'  => 1,
			'panel'  	=> 'front_page_panel',
		)
	); 
	
	$wp_customize->add_setting(
		'sections-order',
		array(
			'transport' => 'postMessage',
		)
	);
	
	$wp_customize->add_control(
		new WP_Sortable_List_Control(
			$wp_customize,
			'sections-order',			
			array(
				'label'          	=> __( 'Sections order', 'entity-power-design' ),
				'section'        	=> 'sections-order',
				'settings'       	=> 'sections-order',
				'items'  		 	=> array(
					"text-slide"		=> __("Slider de textos", "flamel-genosha"),
					"process"			=> __("Proceso de trabajo", "flamel-genosha"),
					"tools"				=> __("Herramientas", "flamel-genosha"),
					"lists"				=> __("Listas", "flamel-genosha"),
					"projects"			=> __("Proyectos", "flamel-genosha"),
					"authors"			=> __("Autores", "flamel-genosha"),
				),
				'description'	 	=> __("Orden en el que se veran las secciones en la landing", "flamel-genosha"),
			)
		)
	);
	
	array_push( $datos_selective_refresh ['sections-order']['settings'], 'sections-order' );
	
	
/*Section intro
*************************************************************************************************************************/	
	
	$wp_customize->add_section(
		'section-intro',
		array(
			'title'     => __('Section intro', "flamel-genosha"),
			'priority'  => 2,
			'panel'  	=> 'front_page_panel',
		)
	); 
	
	$wp_customize->add_setting(
		'section-intro-title',
		array(
			'transport' => 'postMessage',
			'default'	=> "",
		)
	);

	$wp_customize->add_control(
		new WP_Extended_Control(
			$wp_customize,
			'section-intro-title',
			array(
				'label'      => __( 'Titulo', 'flamel-genosha' ),
				'section'    => 'section-intro',
				'settings'   => 'section-intro-title',
				'type'       => 'text',
			)
		)
	);
	
	$wp_customize->add_setting(
		'section-intro-image',
		array(
			'transport' => 'postMessage',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'section-intro-image',
			array(
				'label'     	 	=> __( 'Imagen', 'flamel-genosha' ),
				'section'   	 	=> 'section-intro',
				'settings'   		=> 'section-intro-image',
			)
		)
	);

	$wp_customize->add_setting(
		'section-intro-image-desktop',
		array(
			'transport' => 'postMessage',
		)
	);
	
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'section-intro-image-desktop',
			array(
				'label'     	 	=> __( 'Imagen en desktop', 'flamel-genosha' ),
				'section'   	 	=> 'section-intro',
				'settings'   		=> 'section-intro-image-desktop',
			)
		)
	);
	
	array_push( $datos_selective_refresh ['section-intro']['settings'], 'section-intro-title', 'section-intro-image', 'section-intro-image-desktop' );
	
/*Section lists
*************************************************************************************************************************/	
	
	$wp_customize->add_section(
		'section-lists',
		array(
			'title'     => __('Section lists', "flamel-genosha"),
			'priority'  => 2,
			'panel'  	=> 'front_page_panel',
		)
	); 
	
	$wp_customize->add_setting(
		'section-lists-title',
		array(
			'transport' => 'postMessage',
			'default'	=> "",
		)
	);

	$wp_customize->add_control(
		new WP_List_Generator_Control(
			$wp_customize,
			'section-lists-title',
			array(
				'label'      		=> __( 'Edición de listas', 'flamel-genosha' ),
				'button_content'	=> 'Edit your lists :)',
				'section'    		=> 'section-lists',
				'settings'   		=> 'section-lists-title',
				'type'       		=> 'text',
				'max_num_of_lists'	=> 3,
			)
		)
	);

	array_push( $datos_selective_refresh ['section-lists']['settings'], 'section-lists-title');
	
/*Section: Intro text
*************************************************************************************************************************/	
/*	
	$wp_customize->add_section(
		'text-section',
		array(
			'title'     => 'Section: Intro text',
			'priority'  => 4,
		)
	); 
	
	$wp_customize->add_setting(
		'text-section-show',
		array(
			'transport' => 'postMessage',
			'default'	=> true,
		)
	);

	$wp_customize->add_control(
		new WP_Extended_Control(
			$wp_customize,
			'text-section-show',
			array(
				'label'      => __( 'Show section', 'entity-power-design' ),
				'section'    => 'text-section',
				'settings'   => 'text-section-show',
				'type'       => 'checkbox',
			)
		)
	);
	
	$wp_customize->add_setting(
		'text-section-quote',
		array(
			'transport' => 'postMessage',
			'default'	=> "",
		)
	);

	$wp_customize->add_control(
		new WP_Extended_Control(
			$wp_customize,
			'text-section-quote',
			array(
				'label'      => __( 'Text', 'entity-power-design' ),
				'section'    => 'text-section',
				'settings'   => 'text-section-quote',
				'type'       => 'textarea',
			)
		)
	);

	array_push( $datos_selective_refresh ['text-section']['settings'], 'text-section-show', 'text-section-quote' );
*/




/*Selective refresh render 
*************************************************************************************************************************
*************************************************************************************************************************
*************************************************************************************************************************/

	//Selective refresh render 
	foreach ( $datos_selective_refresh as $section ) {
		$wp_customize->selective_refresh->add_partial( $section['id'],
			array(
				'selector'            => $section ['selector'],
				'settings'			  => $section ['settings'],
				'container_inclusive' => true,
				'render_callback'     => $section ['render_callback'],
				'fallback_refresh'    => false
			)
		);			
	}
}
add_action( 'customize_register', 'mutant_customizer_register_settings' );
/*
function customizer_live_preview()
{
	wp_enqueue_script( 'livePreview',  get_stylesheet_directory_uri().'/javascripts/customizer-live-preview.js', array( 'customize-preview', 'jquery' ) );
}	
add_action( 'customize_preview_init', 'customizer_live_preview' );

function tuts_customize_control_js() {
	
    wp_enqueue_script( 'customizer_control', get_template_directory_uri() . '/javascripts/customizer-control.js', array( 'customize-controls', 'jquery' ), null, true );
}
add_action( 'customize_controls_enqueue_scripts', 'tuts_customize_control_js' );
*/

?>