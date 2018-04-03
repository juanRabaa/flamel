<?php
require get_template_directory() . '/inc/rb-customizer-panel-builder.php';


function create_section_separator_controls( $customizer_api, $section ){
	$customizer_api->get_section($section)
	->add_control(//Control creation
		$section.'-separator-info',//id
		RB_Inputs_Control,//control class
		array(//Settings creation
			$section.'-separator-info' => array(
				'options' => array(
					'transport' => 'postMessage',
				),
			)
		),
		array(//Control options
			'label'      			=> __( 'Separador de seccion', 'flamel-genosha' ),
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
	);
}

//Panel builder//
/******************************************************************************/
function customizer_api_configuration($customizer_api){
	require get_template_directory() . '/inc/customizer-controls.php';

	/*Section Intro
	*************************************************************************************************************************/
	$customizer_api->add_panel(
		'front_page_panel',
		array(
			'priority'       => 3,
			'capability'     => 'edit_theme_options',
			'theme_supports' => '',
			'title'          => __('Front Page', 'flamel-genosha'),
			'description'    => __('Configuración del front page', 'flamel-genosha'),
		)
	)
	->add_section(
		'sections-order',
		array(
			'title'     => 'Orden de las secciones',
			'priority'  => 1,
			'panel'  	=> 'front_page_panel',
	    ),
		array(
			'activated' 		=> true,
			'selector'  		=> '#main-sections',
			'render_callback' 	=> function(){
	            load_frontpage_sections();
	        }
		)
	)
	->add_control(//Control creation
		'sections-order',//id
		RB_Sortable_List_Control,//control class
		array(//Settings creation
			'sections-order' => array(
				'options' => array(
					'transport' => 'postMessage',
				),
			)
		),
		array(//Control options
			'label'          	=> __( 'Orden de las secciones', 'flamel-genosha' ),
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
	);

	/*Section Intro
	*************************************************************************************************************************/
	$customizer_api
	->add_section(
		'section-intro',
		array(
	        'title'     => 'Sección: Intro',
	        'priority'  => 2,
	        'panel'  	=> 'front_page_panel',
	    ),
		array(
			'activated' 		=> true,
			'selector'  		=> '#section-intro',
			'render_callback' 	=> function(){
	            get_template_part( "sections/section", "intro" );
	        }
		)
	)
	->add_control(//Control creation
		'section-intro-show',//id
		RB_Extended_Control,//control class
		array(//Settings creation
			'section-intro-show' => array(
				'options' => array(
					'transport' => 'postMessage',
					'default'	=> true,
				),
			)
		),
		array(//Control options
			'label'      			=> __( 'Mostrar la sección', 'flamel-genosha' ),
			'type'       			=> 'checkbox',
			'dependents_controls'	=> array(
				'hide_all'		=> true,
			),
		)
	)
	->add_control(//Control creation
		'section-intro-title',//id
		RB_Extended_Control,//control class
		array(//Settings creation
			'section-intro-title' => array(
				'options' => array(
					'transport' => 'postMessage',
					'default'	=> "Novedades",
				),
				'selective_refresh' => array(
					'activated' 		=> true,
					'selector'  		=> '#section-intro #section-intro-title',
				)
			)
		),
		array(//Control options
            'label'      => __( 'Título', 'flamel-genosha' ),
            'type'       => 'text',
        )
	)
	->add_control(//Control creation
		'section-intro-image',//id
		WP_Customize_Image_Control,//control class
		array(//Settings creation
			'section-intro-image' => array(
				'options' => array(
					'transport' => 'postMessage',
				),
			)
		),
        array(//Control options
			'label'	=> __( 'Imagen', 'flamel-genosha' ),
        )
	)
	->add_control(//Control creation
		'section-intro-image-desktop',//id
		WP_Customize_Image_Control,//control class
		array(//Settings creation
			'section-intro-image-desktop' => array(
				'options' => array(
					'transport' => 'postMessage',
				),
			)
		),
        array(//Control options
			'label'	=> __( 'Imagen en desktop', 'flamel-genosha' ),
        )
	);

	create_section_separator_controls( $customizer_api, 'section-intro' );

	/*Section Text Slider
	*************************************************************************************************************************/
	$customizer_api
	->add_section(
		'section-text-slide',
		array(
	        'title'     => 'Sección: Frases',
	        'priority'  => 2,
	        'panel'  	=> 'front_page_panel',
	    ),
		array(
			'activated' 		=> true,
			'selector'  		=> '#section-text-slide',
			'render_callback' 	=> function(){
	            get_template_part( "sections/section", "text-slide" );
	        }
		)
	)
	->add_control(//Control creation
		'section-text-slide-show',//id
		RB_Extended_Control,//control class
		array(//Settings creation
			'section-text-slide-show' => array(
				'options' => array(
					'transport' => 'postMessage',
					'default'	=> true,
				),
			)
		),
		array(//Control options
			'label'      			=> __( 'Mostrar la sección', 'flamel-genosha' ),
			'type'       			=> 'checkbox',
			'dependents_controls'	=> array(
				'hide_all'		=> true,
			),
		)
	)
	->add_control(//Control creation
		'section-text-slide-title',//id
		RB_Extended_Control,//control class
		array(//Settings creation
			'section-text-slide-title' => array(
				'options' => array(
					'transport' => 'postMessage',
					'default'	=> "Novedades",
				),
				'selective_refresh' => array(
					'activated' 		=> true,
					'selector'  		=> '#section-text-slide .section-title',
				)
			)
		),
		array(//Control options
            'label'      => __( 'Título', 'flamel-genosha' ),
            'type'       => 'text',
        )
	)
	->add_control(//Control creation
		'section-text-slide-duration',//id
		RB_Extended_Control,//control class
		array(//Settings creation
			'section-text-slide-duration' => array(
				'options' => array(
					'default'	=> 4000,
				),
			)
		),
		array(//Control options
			'label'      => __( 'Duración', 'flamel-genosha' ),
			'type'       => 'number',
			'input_attrs' 	 => array(
				'min'   	 => 4000,
			),
			'description'	=> 'En milisegundos',
		)
	)
	->add_control(//Control creation
		'section-text-slide-content',//id
		RB_Single_Input_Generator_Control,//control class
		array(//Settings creation
			'section-text-slide-content' => array(
				'options' => array(
					'transport' => 'refresh',
				),
			)
		),
        array(//Control options
			'label'      			=> __( 'Frases', 'flamel-genosha' ),
			'inputs_types'       	=> array(
				'slide_text'	=>	array(
					'nice_name'		=>	__( 'Text', 'flamel-genosha' ),
					'type'			=>  "textarea",
				),
			),
			'dinamic_label'			=> 'slide_text',
		)
	);

	create_section_separator_controls( $customizer_api, 'section-text-slide' );

	/*Section List
	*************************************************************************************************************************/
	$customizer_api
	->add_section(
		'section-lists',
		array(
	        'title'     => 'Sección: Listas',
	        'priority'  => 2,
	        'panel'  	=> 'front_page_panel',
	    ),
		array(
			'activated' 		=> true,
			'selector'  		=> '#section-lists',
			'render_callback' 	=> function(){
	            get_template_part( "sections/section", "lists" );
	        }
		)
	)
	->add_control(//Control creation
		'section-lists-show',//id
		RB_Extended_Control,//control class
		array(//Settings creation
			'section-lists-show' => array(
				'options' => array(
					'transport' => 'postMessage',
					'default'	=> true,
				),
			)
		),
		array(//Control options
			'label'      			=> __( 'Mostrar la sección', 'flamel-genosha' ),
			'type'       			=> 'checkbox',
			'dependents_controls'	=> array(
				'hide_all'		=> true,
			),
		)
	)
	->add_control(//Control creation
		'section-lists-generator',//id
		RB_List_Generator_Control,//control class
		array(//Settings creation
			'section-lists-generator' => array(
				'options' => array(
					'transport' => 'postMessage',
				),
			)
		),
        array(//Control options
			'label'      		=> __( 'Editor de liustas', 'flamel-genosha' ),
			'button_content'	=> 'Editar las listas',
			'type'       		=> 'text',
			'max_num_of_lists'	=> 3,
		)
	);

	create_section_separator_controls( $customizer_api, 'section-lists' );

	/*Section Process
	*************************************************************************************************************************/
	$customizer_api
	->add_section(
		'section-process',
		array(
	        'title'     => 'Sección: Procesos',
	        'priority'  => 2,
	        'panel'  	=> 'front_page_panel',
	    ),
		array(
			'activated' 		=> true,
			'selector'  		=> '#section-process',
			'render_callback' 	=> function(){
	            get_template_part( "sections/section", "process" );
	        }
		)
	)
	->add_control(//Control creation
		'section-process-show',//id
		RB_Extended_Control,//control class
		array(//Settings creation
			'section-process-show' => array(
				'options' => array(
					'transport' => 'postMessage',
					'default'	=> true,
				),
			)
		),
		array(//Control options
			'label'      			=> __( 'Mostrar la sección', 'flamel-genosha' ),
			'type'       			=> 'checkbox',
			'dependents_controls'	=> array(
				'hide_all'		=> true,
			),
		)
	)
	->add_control(//Control creation
		'section-process-generator',//id
		RB_List_Generator_Control,//control class
		array(//Settings creation
			'section-process-generator' => array(
				'options' => array(
					'default'	=> "",
				),
			)
		),
        array(//Control options
			'label'      		=> __( 'Edición de procesos', 'flamel-genosha' ),
			'button_content'	=> __( 'Editar los procesos', 'flamel-genosha' ),
			'type'       		=> 'text',
			'max_num_of_lists'	=> 3,
		)
	);

	create_section_separator_controls( $customizer_api, 'section-process' );

	/*Section Tools
	*************************************************************************************************************************/
	$customizer_api
	->add_section(
		'section-tools',
		array(
	        'title'     => 'Sección: Herramientas',
	        'priority'  => 2,
	        'panel'  	=> 'front_page_panel',
	    ),
		array(
			'activated' 		=> true,
			'selector'  		=> '#section-tools',
			'render_callback' 	=> function(){
	            get_template_part( "sections/section", "tools" );
	        }
		)
	)
	->add_control(//Control creation
		'section-tools-show',//id
		RB_Extended_Control,//control class
		array(//Settings creation
			'section-tools-show' => array(
				'options' => array(
					'transport' => 'postMessage',
					'default'	=> true,
				),
			)
		),
		array(//Control options
			'label'      			=> __( 'Mostrar la sección', 'flamel-genosha' ),
			'type'       			=> 'checkbox',
			'dependents_controls'	=> array(
				'hide_all'		=> true,
			),
		)
	)
	->add_control(//Control creation
		'section-tools-title',//id
		RB_Extended_Control,//control class
		array(//Settings creation
			'section-tools-title' => array(
				'options' => array(
					'transport' => 'postMessage',
					'default'	=> "Novedades",
				),
				'selective_refresh' => array(
					'activated' 		=> true,
					'selector'  		=> '#section-tools .section-title',
				)
			)
		),
		array(//Control options
            'label'      => __( 'Título', 'flamel-genosha' ),
            'type'       => 'text',
        )
	)
	->add_control(//Control creation
		'section-tools-images',//id
		RB_Gallery_Control,//control class
		array(//Settings creation
			'section-tools-images' => array(
				'options' => array(
					'default'	=> "",
				),
			)
		),
        array(//Control options
			'label'      => __( 'Logos', 'flamel-genosha' ),
		)
	);

	create_section_separator_controls( $customizer_api, 'section-tools' );

	/*Section Tools
	*************************************************************************************************************************/
	$customizer_api
	->add_section(
		'section-projects',
		array(
	        'title'     => 'Sección: Proyectos',
	        'priority'  => 2,
	        'panel'  	=> 'front_page_panel',
	    ),
		array(
			'activated' 		=> true,
			'selector'  		=> '#section-projects',
			'render_callback' 	=> function(){
	            get_template_part( "sections/section", "projects" );
	        }
		)
	)
	->add_control(//Control creation
		'section-projects-show',//id
		RB_Extended_Control,//control class
		array(//Settings creation
			'section-projects-show' => array(
				'options' => array(
					'transport' => 'postMessage',
					'default'	=> true,
				),
			)
		),
		array(//Control options
			'label'      			=> __( 'Mostrar la sección', 'flamel-genosha' ),
			'type'       			=> 'checkbox',
			'dependents_controls'	=> array(
				'hide_all'		=> true,
			),
		)
	)
	->add_control(//Control creation
		'section-projects-title',//id
		RB_Extended_Control,//control class
		array(//Settings creation
			'section-projects-title' => array(
				'options' => array(
					'transport' => 'postMessage',
					'default'	=> "Novedades",
				),
				'selective_refresh' => array(
					'activated' 		=> true,
					'selector'  		=> '#section-projects .section-title',
				)
			)
		),
		array(//Control options
            'label'      => __( 'Título', 'flamel-genosha' ),
            'type'       => 'text',
        )
	)
	->add_control(//Control creation
		'section-projects-amount',//id
		RB_Extended_Control,//control class
		array(//Settings creation
			'section-projects-amount' => array(
				'options' => array(
					'transport' => 'postMessage',
					'default'	=> 3,
				),
			)
		),
        array(//Control options
			'label'      	 => __( 'Maxima cantidad de proyectos', 'flamel-genosha' ),
			'type'       	 => 'number',
			'input_attrs' 	 => array(
				'min'   	 => 1,
			)
		)
	)
	->add_control(//Control creation
		'section-projects-tag',//id
		RB_Single_Input_Control,//control class
		array(//Settings creation
			'section-projects-tag' => array(
				'options' => array(
					'transport' => 'postMessage',
					'default'	=> 3,
				),
			)
		),
        array(//Control options
			'label'      			=> __( 'Tag', 'flamel-genosha' ),
			'input_type'       		=> 'tag',
			'description'			=> 'El tag que tienen que tener los posts para ser tomados como proyectos',
		)
	);

	create_section_separator_controls( $customizer_api, 'section-projects' );

	/*Section Authors
	*************************************************************************************************************************/
	$customizer_api
	->add_section(
		'section-authors',
		array(
	        'title'     => 'Sección: Hablemos',
	        'priority'  => 2,
	        'panel'  	=> 'front_page_panel',
	    ),
		array(
			'activated' 		=> true,
			'selector'  		=> '#section-authors',
			'render_callback' 	=> function(){
	            get_template_part( "sections/section", "authors" );
	        }
		)
	)
	->add_control(//Control creation
		'section-authors-show',//id
		RB_Extended_Control,//control class
		array(//Settings creation
			'section-authors-show' => array(
				'options' => array(
					'transport' => 'postMessage',
					'default'	=> true,
				),
			)
		),
		array(//Control options
			'label'      			=> __( 'Mostrar la sección', 'flamel-genosha' ),
			'type'       			=> 'checkbox',
			'dependents_controls'	=> array(
				'hide_all'		=> true,
			),
		)
	)
	->add_control(//Control creation
		'section-authors-info',//id
		RB_Inputs_Generator_Control,//control class
		array(//Settings creation
			'section-authors-info' => array(
				'options' => array(
					'transport' => 'postMessage',
				),
			)
		),
        array(//Control options
			'label'      			=> __( 'Autores', 'flamel-genosha' ),
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
	);

	create_section_separator_controls( $customizer_api, 'section-authors' );
}

function flamel_customizer_register_settings( $wp_customize ) {
	$customizer_api = new RB_Customizer_API($wp_customize, 'customizer_api_configuration');
	$customizer_api->initialize();
}
add_action( 'customize_register', 'flamel_customizer_register_settings' );
?>
