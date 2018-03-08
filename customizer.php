<?php	
function mutant_customizer_register_settings( $wp_customize ) {

	require get_template_directory() . '/inc/customizer-controls.php';
	
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
			$section.'-separator-info',
			array(
				'transport' => 'postMessage',
			)
		);

		$wp_customize_manager->add_control(
			new WP_Mutan_Inputs_Control(
				$wp_customize_manager,
				$section.'-separator-info',
				array(
					'label'      			=> __( 'Separador de seccion', 'flamel-genosha' ),
					'section'    			=> $section,
					'settings'   			=> $section.'-separator-info',
					'inputs_types'       	=> array(
						'separator_show'	=>	array(
							'nice_name'		=>	__( 'Mostrar el separador', 'flamel-genosha' ),
							'type'			=>  "checkbox",
							'dependencies'	=> 1,
						),
						'separator_post'	=>	array(
							'nice_name'		=>	__( 'Proyecto', 'flamel-genosha' ),
							'type'			=>  "post",
						),
						'separator_link_text'	=>	array(
							'nice_name'		=>	__( 'Texto del link', 'flamel-genosha' ),
							'type'			=>  "text",
						),
						'separator_use_thumbnail'	=>	array(
							'nice_name'				=>	__( 'Usar imagen del proyecto como separador', 'flamel-genosha' ),
							'type'					=>  "checkbox",
							'dependencies'			=> 'separator_image',
							'reverse_dependencies'	=> true,
						),	
						'separator_image'		=>	array(
							'nice_name'		=>	__( 'Imagen', 'flamel-genosha' ),
							'type'			=>  "image",
						),					
					),				
				)				
			)
		);

		array_push( $selective_refresh_array [$section]['settings'], "$section-separator-info");
	
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

		'section-authors' => array(
			'id' => 'section-authors',
			'selector' => '#section-authors',
			'settings' => array(
			),
			'render_callback' => function(){
				get_template_part( "sections/section", "authors" );
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
			'title'     => 'Orden de las secciones',
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
				'label'          	=> __( 'Orden de las secciones', 'flamel-genosha' ),
				'section'        	=> 'sections-order',
				'settings'       	=> 'sections-order',
				'items'  		 	=> array(
					"text-slide"		=> __("Frases", "flamel-genosha"),
					"process"			=> __("Proceso de trabajo", "flamel-genosha"),
					"tools"				=> __("Herramientas", "flamel-genosha"),
					"lists"				=> __("Listas", "flamel-genosha"),
					"projects"			=> __("Proyectos", "flamel-genosha"),
					"authors"			=> __("Hablemos", "flamel-genosha"),
				),
				'description'	 	=> __("Orden en el que se veran las secciones del front page", "flamel-genosha"),
			)
		)
	);
	
	array_push( $datos_selective_refresh ['sections-order']['settings'], 'sections-order' );
	
	
/*Section intro
*************************************************************************************************************************/	
	
	$wp_customize->add_section(
		'section-intro',
		array(
			'title'     => __('Sección: Intro', "flamel-genosha"),
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
				'label'      			=> __( 'Mostrar sección', 'flamel-genosha' ),
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
				'label'      => __( 'título', 'flamel-genosha' ),
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
			'title'     => __('Sección: Frases', "flamel-genosha"),
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
				'label'      			=> __( 'Mostrar sección', 'flamel-genosha' ),
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
				'label'      => __( 'Duración', 'flamel-genosha' ),
				'section'    => 'section-text-slide',
				'settings'   => 'section-text-slide-duration',
				'type'       => 'number',
				'input_attrs' 	 => array(
					'min'   	 => 4000,
				),
				'description'	=> 'En milisegundos',
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
				'label'      => __( 'Título', 'flamel-genosha' ),
				'section'    => 'section-text-slide',
				'settings'   => 'section-text-slide-title',
				'type'       => 'text',
			)
		)
	);

	$wp_customize->add_setting(
		'section-text-slide-content',
		array(
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Single_Input_Generator_Control(
			$wp_customize,
			'section-text-slide-content',
			array(
				'label'      			=> __( 'Frases', 'flamel-genosha' ),
				'section'    			=> 'section-text-slide',
				'settings'   			=> 'section-text-slide-content',
				'inputs_types'       	=> array(
					'slide_text'	=>	array(
						'nice_name'		=>	__( 'Text', 'flamel-genosha' ),
						'type'			=>  "textarea",
					),					
				),
				'dinamic_label'			=> 'slide_text',
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
			'title'     => __('Sección: Listas', "flamel-genosha"),
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
				'label'      			=> __( 'Mostrar sección', 'flamel-genosha' ),
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
				'button_content'	=> 'Editar las listas',
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
			'title'     => __('Sección: Procesos', "flamel-genosha"),
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
				'label'      			=> __( 'Mostrar sección', 'flamel-genosha' ),
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
				'label'      => __( 'Título', 'flamel-genosha' ),
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
				'button_content'	=> __( 'Editar los procesos', 'flamel-genosha' ),
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
				'title'     => __('Sección: Herramientas', "flamel-genosha"),
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
					'label'      			=> __( 'Mostrar sección', 'flamel-genosha' ),
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
			)
		);

		$wp_customize->add_control(
			new WP_Mutan_Gallery_Control(
				$wp_customize,
				'section-tools', 
				array(
					'label'      => __( 'Logos', 'flamel-genosha' ),
					'section'    => 'section-tools', 
					'settings'   => 'section-tools-images', 
				)
			)
		);
		
		create_section_separator_controls( $wp_customize, 'section-tools', $datos_selective_refresh);
		
		array_push( $datos_selective_refresh ['section-tools']['settings'],  'section-tools-show', 'section-tools-images');
	
	}

/*Section projects
*************************************************************************************************************************/	
	
	$wp_customize->add_section(
		'section-projects',
		array(
			'title'     => __('Sección: Proyectos', "flamel-genosha"),
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
				'label'      			=> __( 'Mostrar sección', 'flamel-genosha' ),
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
				'label'      	 => __( 'Maxima cantidad de proyectos', 'flamel-genosha' ),
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
		new Rabas_Single_Input_Control(
			$wp_customize,
			'section-projects-tag',
			array(
				'label'      			=> __( 'Tag', 'flamel-genosha' ),
				'section'    			=> 'section-projects',
				'settings'   			=> 'section-projects-tag',
				'input_type'       		=> 'tag',
				'description'			=> 'El tag que tienen que tener los posts para ser tomados como proyectos',
			)
		)
	);	
	
	create_section_separator_controls( $wp_customize, 'section-projects', $datos_selective_refresh);
	
	array_push( $datos_selective_refresh ['section-projects']['settings'], 'section-projects-show', 'section-projects-amount', 'section-projects-tag');

/*Section authors
*************************************************************************************************************************/	
	
	$wp_customize->add_section(
		'section-authors',
		array(
			'title'     => __('Sección: Hablemos', "flamel-genosha"),
			'priority'  => 2,
			'panel'  	=> 'front_page_panel',
		)
	); 

	$wp_customize->add_setting(
		'section-authors-show',
		array(
			'transport' => 'postMessage',
			'default'	=> true,
		)
	);

	$wp_customize->add_control(
		new WP_Extended_Control(
			$wp_customize,
			'section-authors-show',
			array(
				'label'      			=> __( 'Mostrar sección', 'flamel-genosha' ),
				'section'    			=> 'section-authors',
				'settings'   			=> 'section-authors-show',
				'type'       			=> 'checkbox',
				'dependents_controls'	=> array(
					'hide_all'		=> true,
				),
			)
		)
	);
	
	$wp_customize->add_setting(
		'section-authors-info',
		array(
			'transport' => 'postMessage',
		)
	);

	$wp_customize->add_control(
		new WP_Inputs_Generator_Control(
			$wp_customize,
			'section-authors-info',
			array(
				'label'      			=> __( 'Autores', 'flamel-genosha' ),
				'section'    			=> 'section-authors',
				'settings'   			=> 'section-authors-info',
				'inputs_types'       	=> array(
					'author_name'	=>	array(
						'nice_name'		=>	__( 'Nombre', 'flamel-genosha' ),
						'type'			=>  "text",
					),
					'author_ocupation'	=>	array(
						'nice_name'		=>	__( 'Ocupación', 'flamel-genosha' ),
						'type'			=>  "text",
					),
					'author_mail'	=>	array(
						'nice_name'		=>	__( 'Mail', 'flamel-genosha' ),
						'type'			=>  "text",
					),
					'author_pic'	=>	array(
						'nice_name'		=>	__( 'Imagen', 'flamel-genosha' ),
						'type'			=>  "image",
					),
					'author_bio'	=>	array(
						'nice_name'		=>	__( 'Bio', 'flamel-genosha' ),
						'type'			=>  "textarea",
					),							
				),
				'disable_generator'		=> false,		
				'dinamic_label'			=> 'author_name',
			)				
		)
	);
	
	create_section_separator_controls( $wp_customize, 'section-authors', $datos_selective_refresh);
	
	array_push( $datos_selective_refresh ['section-authors']['settings'], 'section-authors-show', 'section-authors-info');
	
	
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