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

	function create_section_separator_controls( &$wp_customize_manager, $section, &$selective_refresh_array){
	
		$wp_customize_manager->add_setting(
			$section.'-separator-show',
			array(
				'transport' => 'postMessage',
				'default'	=> true,
			)
		);

		$wp_customize_manager->add_control(
			new WP_Extended_Control(
				$wp_customize_manager,
				$section.'-separator-show',
				array(
					'label'      			=> __( 'Use image separator', 'flamel-genosha' ),
					'section'    			=> $section,
					'settings'   			=> $section.'-separator-show',
					'type'       			=> 'checkbox',
					'dependents_controls'	=> array(
						'controls' => ["$section-separator-post","$section-separator-text","$section-separator-use-thumbnail", "$section-separator-image"],
					),
					'separator_content'		=> __( 'Opciones de separador', 'flamel-genosha' ),					
				)
			)
		);

		$wp_customize_manager->add_setting(
			$section.'-separator-post',
			array(
				'transport' => 'postMessage',
			)
		);

		$wp_customize_manager->add_control(
			new WP_Taxonomy_Dropdown_Control(
				$wp_customize_manager,
				$section.'-separator-post',
				array(
					'label'      			=> __( 'Choose post', 'flamel-genosha' ),
					'section'    			=> $section,
					'settings'   			=> $section.'-separator-post',
					'type'       			=> 'posts',
					'description'			=> 'Post to wich the separator will link to',
					'show_option_none'		=> 'None',
					'dependents_controls'	=> array(
						'controls' => ["$section-separator-text"],
					),					
				)
			)
		);	

		$wp_customize_manager->add_setting(
			$section.'-separator-text',
			array(
				'transport' => 'postMessage',
				'default'	=> "",
			)
		);

		$wp_customize_manager->add_control(
			new WP_Extended_Control(
				$wp_customize_manager,
				$section.'-separator-text',
				array(
					'label'      => __( 'Separator link text', 'flamel-genosha' ),
					'section'    => $section,
					'settings'   => $section.'-separator-text',
					'type'       => 'text',
				)
			)
		);

		$wp_customize_manager->add_setting(
			$section.'-separator-use-thumbnail',
			array(
				'transport' => 'postMessage',
				'default'	=> true,
			)
		);

		$wp_customize_manager->add_control(
			new WP_Extended_Control(
				$wp_customize_manager,
				$section.'-separator-use-thumbnail',
				array(
					'label'      			=> __( 'Use post thumbnail as image', 'flamel-genosha' ),
					'section'    			=> $section,
					'settings'   			=> $section.'-separator-use-thumbnail',
					'type'       			=> 'checkbox',
					'dependents_controls'	=> array(
						'controls' => ["$section-separator-image"],
						'reverse'  => true,
					),
				)
			)
		);
		
		$wp_customize_manager->add_setting(
			$section.'-separator-image',
			array(
				'transport' => 'postMessage',
			)
		);
		
		$wp_customize_manager->add_control(
			new WP_Customize_Image_Control(
				$wp_customize_manager,
				$section.'-separator-image',
				array(
					'label'     	 	=> __( 'Separator image', 'flamel-genosha' ),
					'section'   	 	=> $section,
					'settings'   		=> $section.'-separator-image',
				)
			)
		);
	
		array_push( $selective_refresh_array [$section]['settings'], "$section-separator-show", "$section-separator-post","$section-separator-text","$section-separator-image","$section-separator-use-thumbnail" );
	
	}
	
    
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

		'section-text-slide' => array(
			'id' => 'section-text-slide',
			'selector' => '#section-text-slide',
			'settings' => array(
			),
			'render_callback' => function(){
				get_template_part( "sections/section", "text-slide" );
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

		'section-process' => array(
			'id' => 'section-process',
			'selector' => '#section-process',
			'settings' => array(
			),
			'render_callback' => function(){
				get_template_part( "sections/section", "process" );
			}
		),	
		
		'section-tools' => array(
			'id' => 'section-tools',
			'selector' => '#section-tools',
			'settings' => array(
			),
			'render_callback' => function(){
				get_template_part( "sections/section", "tools" );
			}
		),

		'section-projects' => array(
			'id' => 'section-projects',
			'selector' => '#section-projects',
			'settings' => array(
			),
			'render_callback' => function(){
				get_template_part( "sections/section", "projects" );
			}
		),			
	);	
	
/*Sections panel
*************************************************************************************************************************/
$wp_customize->add_panel( 'front_page_panel', array(
	'priority'       => 3,
	'capability'     => 'edit_theme_options',
	'theme_supports' => '',
	'title'          => __('Front page', 'flamel-genosha'),
	'description'    => __('Front page settings', 'flamel-genosha'),
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
				'label'          	=> __( 'Sections order', 'flamel-genosha' ),
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
		'section-intro-show',
		array(
			'transport' => 'postMessage',
			'default'	=> true,
		)
	);
/*"$section-separator-show", "$section-separator-post","$section-separator-text","$section-separator-image"*/
	$wp_customize->add_control(
		new WP_Extended_Control(
			$wp_customize,
			'section-intro-show',
			array(
				'label'      			=> __( 'Show section', 'flamel-genosha' ),
				'section'    			=> 'section-intro',
				'settings'   			=> 'section-intro-show',
				'type'       			=> 'checkbox',
				'dependents_controls'	=> array(
					'hide_all'		=> true,
				),
			)
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
	
	create_section_separator_controls( $wp_customize, 'section-intro', $datos_selective_refresh);
	
	array_push( $datos_selective_refresh ['section-intro']['settings'], 'section-intro-show', 'section-intro-title', 'section-intro-image', 'section-intro-image-desktop' );
	
/*Section text slider
*************************************************************************************************************************/	
	
	$wp_customize->add_section(
		'section-text-slide',
		array(
			'title'     => __('Section text slider', "flamel-genosha"),
			'priority'  => 2,
			'panel'  	=> 'front_page_panel',
		)
	); 

	$wp_customize->add_setting(
		'section-text-slide-show',
		array(
			'transport' => 'postMessage',
			'default'	=> true,
		)
	);

	$wp_customize->add_control(
		new WP_Extended_Control(
			$wp_customize,
			'section-text-slide-show',
			array(
				'label'      			=> __( 'Show section', 'flamel-genosha' ),
				'section'    			=> 'section-text-slide',
				'settings'   			=> 'section-text-slide-show',
				'type'       			=> 'checkbox',
				'dependents_controls'	=> array(
					'hide_all'		=> true,
				),
			)
		)
	);

	$wp_customize->add_setting(
		'section-text-slide-duration',
		array(
			//'transport' => 'postMessage',
			'default'	=> 4000,
		)
	);

	$wp_customize->add_control(
		new WP_Extended_Control(
			$wp_customize,
			'section-text-slide-duration',
			array(
				'label'      => __( 'Duration', 'flamel-genosha' ),
				'section'    => 'section-text-slide',
				'settings'   => 'section-text-slide-duration',
				'type'       => 'number',
				'input_attrs' 	 => array(
					'min'   	 => 4000,
				),				
			)
		)
	);
	
	$wp_customize->add_setting(
		'section-text-slide-title',
		array(
			'transport' => 'postMessage',
			'default'	=> "",
		)
	);

	$wp_customize->add_control(
		new WP_Extended_Control(
			$wp_customize,
			'section-text-slide-title',
			array(
				'label'      => __( 'Titulo', 'flamel-genosha' ),
				'section'    => 'section-text-slide',
				'settings'   => 'section-text-slide-title',
				'type'       => 'text',
			)
		)
	);

	$wp_customize->add_setting(
		'section-text-slide-content',
		array(
			'default'	=> "",
		)
	);

	$wp_customize->add_control(
		new WP_Textarea_Generator_Control(
			$wp_customize,
			'section-text-slide-content',
			array(
				'label'      => __( 'Textos', 'flamel-genosha' ),
				'section'    => 'section-text-slide',
				'settings'   => 'section-text-slide-content',
				'type'       => 'text',
			)
		)
	);
	
	create_section_separator_controls( $wp_customize, 'section-text-slide', $datos_selective_refresh);
	
	array_push( $datos_selective_refresh ['section-text-slide']['settings'], 'section-text-slide-title', 'section-text-slide-duration', 'section-text-slide-show' );
	
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
		'section-lists-show',
		array(
			'transport' => 'postMessage',
			'default'	=> true,
		)
	);

	$wp_customize->add_control(
		new WP_Extended_Control(
			$wp_customize,
			'section-lists-show',
			array(
				'label'      			=> __( 'Show section', 'flamel-genosha' ),
				'section'    			=> 'section-lists',
				'settings'   			=> 'section-lists-show',
				'type'       			=> 'checkbox',
				'dependents_controls'	=> array(
					'hide_all'		=> true,
				),		
			)
		)
	);
	
	$wp_customize->add_setting(
		'section-lists-generator',
		array(
			'transport' => 'postMessage',
			'default'	=> "",
		)
	);

	$wp_customize->add_control(
		new WP_List_Generator_Control(
			$wp_customize,
			'section-lists-generator',
			array(
				'label'      		=> __( 'Edición de listas', 'flamel-genosha' ),
				'button_content'	=> 'Edit your lists :)',
				'section'    		=> 'section-lists',
				'settings'   		=> 'section-lists-generator',
				'type'       		=> 'text',
				'max_num_of_lists'	=> 3,
			)
		)
	);
	
	create_section_separator_controls( $wp_customize, 'section-lists', $datos_selective_refresh);

	array_push( $datos_selective_refresh ['section-lists']['settings'], 'section-lists-show', 'section-lists-generator');

/*Section process
*************************************************************************************************************************/	
	
	$wp_customize->add_section(
		'section-process',
		array(
			'title'     => __('Section process', "flamel-genosha"),
			'priority'  => 2,
			'panel'  	=> 'front_page_panel',
		)
	); 

	$wp_customize->add_setting(
		'section-process-show',
		array(
			'transport' => 'postMessage',
			'default'	=> true,
		)
	);

	$wp_customize->add_control(
		new WP_Extended_Control(
			$wp_customize,
			'section-process-show',
			array(
				'label'      			=> __( 'Show section', 'flamel-genosha' ),
				'section'    			=> 'section-process',
				'settings'   			=> 'section-process-show',
				'type'       			=> 'checkbox',
				'dependents_controls'	=> array(
					'hide_all'		=> true,
				),
			)
		)
	);
	
	$wp_customize->add_setting(
		'section-process-title',
		array(
			//'transport' => 'postMessage',
			'default'	=> "",
		)
	);

	$wp_customize->add_control(
		new WP_Extended_Control(
			$wp_customize,
			'section-process-title',
			array(
				'label'      => __( 'Titulo', 'flamel-genosha' ),
				'section'    => 'section-process',
				'settings'   => 'section-process-title',
				'type'       => 'text',
			)
		)
	);
	
	$wp_customize->add_setting(
		'section-process-generator',
		array(
			//'transport' => 'postMessage',
			'default'	=> "",
		)
	);

	$wp_customize->add_control(
		new WP_List_Generator_Control(
			$wp_customize,
			'section-process-generator',
			array(
				'label'      		=> __( 'Edición de procesos', 'flamel-genosha' ),
				'button_content'	=> __( 'Edit the process', 'flamel-genosha' ),
				'section'    		=> 'section-process',
				'settings'   		=> 'section-process-generator',
				'type'       		=> 'text',
				'max_num_of_lists'	=> 3,
			)
		)
	);
	
	create_section_separator_controls( $wp_customize, 'section-process', $datos_selective_refresh);

	array_push( $datos_selective_refresh ['section-process']['settings'], 'section-process-show', 'section-process-generator', 'section-process-title');

	
/*Section tools
*************************************************************************************************************************/	
	if ( class_exists("CustomizeImageGalleryControl\Control")){
			
		$wp_customize->add_section(
			'section-tools',
			array(
				'title'     => __('Section tools', "flamel-genosha"),
				'priority'  => 2,
				'panel'  	=> 'front_page_panel',
			)
		); 

		$wp_customize->add_setting(
			'section-tools-show',
			array(
				'transport' => 'postMessage',
				'default'	=> true,
			)
		);

		$wp_customize->add_control(
			new WP_Extended_Control(
				$wp_customize,
				'section-tools-show',
				array(
					'label'      			=> __( 'Show section', 'flamel-genosha' ),
					'section'    			=> 'section-tools',
					'settings'   			=> 'section-tools-show',
					'type'       			=> 'checkbox',
					'dependents_controls'	=> array(
						'hide_all'		=> true,
					),
				)
			)
		);
	
		$wp_customize->add_setting( 
			'section-tools-images', 
			array(
				'transport' => 'postMessage',
				'default' => array(),
				'sanitize_callback' => 'wp_parse_id_list',
			)
		);
		
		$wp_customize->add_control( new CustomizeImageGalleryControl\Control(
			$wp_customize,
			'section-tools-images',
			array(
				'label'    => __( 'Image Gallery Field Label' ),
				'section'  => 'section-tools',
				'settings' => 'section-tools-images',
				'type'     => 'image_gallery',
			)
		) );
		
		create_section_separator_controls( $wp_customize, 'section-tools', $datos_selective_refresh);
		
		array_push( $datos_selective_refresh ['section-tools']['settings'],  'section-tools-show', 'section-tools-images');
	
	}

/*Section projects
*************************************************************************************************************************/	
	
	$wp_customize->add_section(
		'section-projects',
		array(
			'title'     => __('Section projects', "flamel-genosha"),
			'priority'  => 2,
			'panel'  	=> 'front_page_panel',
		)
	); 

	$wp_customize->add_setting(
		'section-projects-show',
		array(
			'transport' => 'postMessage',
			'default'	=> true,
		)
	);

	$wp_customize->add_control(
		new WP_Extended_Control(
			$wp_customize,
			'section-projects-show',
			array(
				'label'      			=> __( 'Show section', 'flamel-genosha' ),
				'section'    			=> 'section-projects',
				'settings'   			=> 'section-projects-show',
				'type'       			=> 'checkbox',
				'dependents_controls'	=> array(
					'hide_all'		=> true,
				),
			)
		)
	);

	$wp_customize->add_setting(
		'section-projects-amount',
		array(
			'transport' => 'postMessage',
			'default'	=> 3,
		)
	);

	$wp_customize->add_control(
		new WP_Extended_Control(
			$wp_customize,
			'section-projects-amount',
			array(
				'label'      	 => __( 'Max amount of projects', 'flamel-genosha' ),
				'section'    	 => 'section-projects',
				'settings'  	 => 'section-projects-amount',
				'type'       	 => 'number',
				'input_attrs' 	 => array(
					'min'   	 => 1,
				),				
			)
		)
	);
	
	$wp_customize->add_setting(
		'section-projects-tag',
		array(
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Taxonomy_Dropdown_Control(
			$wp_customize,
			'section-projects-tag',
			array(
				'label'      			=> __( 'Choose tag', 'flamel-genosha' ),
				'section'    			=> 'section-projects',
				'settings'   			=> 'section-projects-tag',
				'type'       			=> 'tags',
				'description'			=> 'Post with this tag will be displayed as proyects',
			)
		)
	);	
	
	create_section_separator_controls( $wp_customize, 'section-projects', $datos_selective_refresh);
	
	array_push( $datos_selective_refresh ['section-projects']['settings'], 'section-projects-show', 'section-projects-amount', 'section-projects-tag');

	
	
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
				'label'      => __( 'Show section', 'flamel-genosha' ),
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
				'label'      => __( 'Text', 'flamel-genosha' ),
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