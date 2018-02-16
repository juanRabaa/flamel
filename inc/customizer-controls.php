<?php
/*
*
*	Custom controls for customizer
*
*/

if( ! function_exists( 'wp_dropdown_posts' ) ) {
	/**
	 * Create dropdown HTML content of posts
	 *
	 * The content can either be displayed, which it is by default or retrieved by
	 * setting the 'echo' argument. The 'include' and 'exclude' arguments do not
	 * need to be used; all published posts will be displayed in that case.
	 *
	 * Supports all WP_Query arguments
	 * @see https://codex.wordpress.org/Class_Reference/WP_Query
	 *
	 * The available arguments are as follows:
	 *
	 * @author Myles McNamara
	 * @website https://smyl.es
	 * @updated March 29, 2016
	 *
	 * @since 1.0.0
	 *
	 * @param array|string $args {
	 *     Optional. Array or string of arguments to generate a drop-down of posts.
	 *     {@see WP_Query for additional available arguments.
	 *
	 *     @type string       $show_option_all         Text to show as the drop-down default (all).
	 *                                                 Default empty.
	 *     @type string       $show_option_none        Text to show as the drop-down default when no
	 *                                                 posts were found. Default empty.
	 *     @type int|string   $option_none_value       Value to use for $show_option_non when no posts
	 *                                                 were found. Default -1.
	 *     @type array|string $show_callback           Function or method to filter display value (label)
	 *
	 *     @type string       $orderby                 Field to order found posts by.
	 *                                                 Default 'post_title'.
	 *     @type string       $order                   Whether to order posts in ascending or descending
	 *                                                 order. Accepts 'ASC' (ascending) or 'DESC' (descending).
	 *                                                 Default 'ASC'.
	 *     @type array|string $include                 Array or comma-separated list of post IDs to include.
	 *                                                 Default empty.
	 *     @type array|string $exclude                 Array or comma-separated list of post IDs to exclude.
	 *                                                 Default empty.
	 *     @type bool|int     $multi                   Whether to skip the ID attribute on the 'select' element.
	 *                                                 Accepts 1|true or 0|false. Default 0|false.
	 *     @type string       $show                    Post table column to display. If the selected item is empty
	 *                                                 then the Post ID will be displayed in parentheses.
	 *                                                 Accepts post fields. Default 'post_title'.
	 *     @type int|bool     $echo                    Whether to echo or return the drop-down. Accepts 1|true (echo)
	 *                                                 or 0|false (return). Default 1|true.
	 *     @type int          $selected                Which post ID should be selected. Default 0.
	 *     @type string       $select_name             Name attribute of select element. Default 'post_id'.
	 *     @type string       $id                      ID attribute of the select element. Default is the value of $select_name.
	 *     @type string       $class                   Class attribute of the select element. Default empty.
	 *     @type array|string $post_status             Post status' to include, default publish
	 *     @type string       $who                     Which type of posts to query. Accepts only an empty string or
	 *                                                 'authors'. Default empty.
	 * }
	 * @return string String of HTML content.
	 */
	function wp_dropdown_posts( $args = '' ) {
		$defaults = array(
			'selected'              => FALSE,
			'pagination'            => FALSE,
			'posts_per_page'        => - 1,
			'post_status'           => 'publish',
			'cache_results'         => TRUE,
			'cache_post_meta_cache' => TRUE,
			'echo'                  => 1,
			'select_name'           => 'post_id',
			'id'                    => '',
			'class'                 => '',
			'show'                  => 'post_title',
			'show_callback'         => NULL,
			'show_option_all'       => NULL,
			'show_option_none'      => NULL,
			'option_none_value'     => '',
			'multi'                 => FALSE,
			'value_field'           => 'ID',
			'order'                 => 'ASC',
			'orderby'               => 'post_title',
		);
		$r = wp_parse_args( $args, $defaults );
		$posts  = get_posts( $r );
		$output = '';
		$show = $r['show'];
		if( ! empty($posts) ) {
			$name = esc_attr( $r['select_name'] );
			if( $r['multi'] && ! $r['id'] ) {
				$id = '';
			} else {
				$id = $r['id'] ? " id='" . esc_attr( $r['id'] ) . "'" : " id='$name'";
			}
			$output = "<select name='{$name}'{$id} class='" . esc_attr( $r['class'] ) . "'>\n";
			if( $r['show_option_all'] ) {
				$output .= "\t<option value='0'>{$r['show_option_all']}</option>\n";
			}
			if( $r['show_option_none'] ) {
				$_selected = selected( $r['show_option_none'], $r['selected'], FALSE );
				$output .= "\t<option value='" . esc_attr( $r['option_none_value'] ) . "'$_selected>{$r['show_option_none']}</option>\n";
			}
			foreach( (array) $posts as $post ) {
				$value   = ! isset($r['value_field']) || ! isset($post->{$r['value_field']}) ? $post->ID : $post->{$r['value_field']};
				$_selected = selected( $value, $r['selected'], FALSE );
				$display = ! empty($post->$show) ? $post->$show : sprintf( __( '#%d (no title)' ), $post->ID );
				if( $r['show_callback'] ) $display = call_user_func( $r['show_callback'], $display, $post->ID );
				$output .= "\t<option value='{$value}'{$_selected}>" . esc_html( $display ) . "</option>\n";
			}
			$output .= "</select>";
		}
		/**
		 * Filter the HTML output of a list of pages as a drop down.
		 *
		 * @since 1.0.0
		 *
		 * @param string $output HTML output for drop down list of posts.
		 * @param array  $r      The parsed arguments array.
		 * @param array  $posts  List of WP_Post objects returned by `get_posts()`
		 */
		$html = apply_filters( 'wp_dropdown_posts', $output, $r, $posts );
		if( $r['echo'] ) {
			echo $html;
		}
		return $html;
	}
}



	class WP_Extended_Control extends WP_Customize_Control {
		public $li_classes = "";

		protected function render() {
			$id    = 'customize-control-' . str_replace( array( '[', ']' ), array( '-', '' ), $this->id );
			$class = 'customize-control customize-control-' . $this->type . " " . $this->li_classes;
	 
			?><li id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $class ); ?>">
				<?php $this->render_content(); ?>
			</li><?php
		}
	}
	
	/*TO BE DEPRECATED
	*Use WP_Taxonomy_Dropdown_Control, with type => 'category' 
	*/
	class WP_Customize_Category_Control extends WP_Extended_Control {
		public $show_option_none = '&mdash; Select &mdash;';
		/**
		 * Render the control's content.
		 *
		 * @since 3.4.0
		 */
		public function render_content() {
			 
			$dropdown = wp_dropdown_categories(
				array(
					'name'              => '_customize-dropdown-categories-' . $this->id,
					'echo'              => 0,
					'show_option_none'  => __( $this->show_option_none ),
					'option_none_value' => '0',
					'selected'          => $this->value(),
				)
			);
 
			// Hackily add in the data link parameter.
			$dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
 
			printf(
				'<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
				$this->label,
				$dropdown
			);
		}
	}
		
	class WP_Taxonomy_Dropdown_Control extends WP_Extended_Control {
		public $show_option_none = '&mdash; Select &mdash;';
		/**
		 * Render the control's content.
		 *
		 * @since 3.4.0
		 */
		public function render_content() {
			$dropdown = null;
			switch ( $this->type ){			
				case "categories":
					$dropdown = wp_dropdown_categories(
						array(
							'name'              => '_customize-dropdown-categories-' . $this->id,
							'echo'              => 0,
							'show_option_none'  => __( $this->show_option_none ),
							'option_none_value' => '0',
							'selected'          => $this->value(),
						)
					);					
				break;
				case "tags":
					$dropdown = wp_dropdown_categories(
						array(
							'name'              => '_customize-dropdown-categories-' . $this->id,
							'echo'              => 0,
							'show_option_none'  => __( $this->show_option_none ),
							'option_none_value' => '0',
							'selected'          => $this->value(),
							'taxonomy'			=> 'post_tag',
						)
					);					
				break;				
				case "pages":
					$dropdown = wp_dropdown_pages(
						array(
							'name'              => '_customize-dropdown-pages-' . $this->id,
							'echo'              => 0,
							'show_option_none'  => __( $this->show_option_none ),
							'option_none_value' => '0',
							'selected'          => $this->value(),
						)
					);					
				break;
				case "posts":
					$dropdown = "<select
						name='_customize-dropdown-posts-". $this->id . "'
						id='_customize-dropdown-posts-". $this->id . "'		
					>";
					$dropdown .= '<option value=""'.selected($this->value(), $post->ID, false).'>'.__( $this->show_option_none ).'</option>';
					$posts = get_posts(array(
						'posts_per_page'       	=> -1,
						'orderby'				=> 'title',
					));
					foreach ( $posts as $post ){
						$dropdown .= '<option value="'. $post->ID .'"'.selected($this->value(), $post->ID, false).'>'.$post->post_title.'</option>';
					}	
					
					$dropdown .= "</section>";
				break;			
			}
			
			if ( $dropdown ){
				// Hackily add in the data link parameter.
				$dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
	 
				?>
				<label class="customize-control-select">
					<span class="customize-control-title">
						<?php echo $this->label; ?>
					</span>
					<?php echo $dropdown; ?>
				</label>
				<?php
			}
			else{
				?>
				<label class="customize-control-select">
					<span class="customize-control-title">
						<?php echo $this->label; ?>
					</span>
					
					<p>Error: a WP_Taxonomy_Dropdown_Control instance need to be given a valid 'type'.</p>
					<p>Current valid types are:</p>
					<ul>
						<li>"pages"</li>
						<li>"categories"</li>
						<li>"posts"</li>
					</ul>
				</label>
				<?php
			}
		}
	}	
	
	class WP_Extended_Select_Control extends WP_Extended_Control {
		public $show_option_none = '&mdash; None &mdash;';
		/**
		 * Render the control's content.
		 *
		 * @since 3.4.0
		 */
		public function render_content() {
			$dropdown = "<select ". $this->get_link() . ">";
			$dropdown = $dropdown . "<option value='' selected>".$this->show_option_none."</option>";
			
			foreach( $this->choices as $option ){
				$dropdown = $dropdown . "<option value='".$option."'>".substr( $option, 0, strlen($option) - 4)."</option>";
			}
			
			$dropdown = $dropdown . "</select>";

			printf(
				'<label class="customize-control-select"><span class="customize-control-title">%s</span>
				<span class="description customize-control-description"> %s</span> %s</label>',
				$this->label,
				$this->description,
				$dropdown
			);
		}
	}

	/*TO ADD
	/***Option to not use zoom in
	/***Add the possibility to use MULTIPLE IMAGES per IMAGE CHOICE, and display a carousel on the 'zoom in' view, with all those images
	*/
	class WP_Select_By_Image extends WP_Extended_Control {
		/**
		*	Array with the images to use. Every image inside the array must respect this format:
		*		$file_without_ext => array(
		*			'value'			=> 'This option value',
		*			'src'			=> 'The image src',
		*			'nice_name'		=> 'A nice name'
		*		)		
		*/
		public $images = array();

		/**
		*	String. Defines the max width of the image container. This defines how many images will be seen by row. Default 33%: shows
		*three images per row
		*/
		public $max_width = "33%";
		
		/**
		 * Render the control's content.
		 *
		 * @since 3.4.0
		 */
		 
		public function __construct($manager, $id, $args = array())
		{
			parent::__construct($manager, $id, $args);
			
			$this->images = $args["images"];
			$this->max_width = $args["max_width"];
		/*	echo "aca\n";
			print_r($this->setting->value());*/
		}
	
		public function render_content() {
			$name = '_customize-image-radio-' . $this->id;
			$input_id = '_customize-input-' . $this->id;
			$description_id = '_customize-description-' . $this->id;
			$describedby_attr = ( ! empty( $this->description ) ) ? ' aria-describedby="' . esc_attr( $description_id ) . '" ' : '';
			
			?>
			<label class="customize-control-select">
				<span class="customize-control-title"><?php echo $this->label; ?></span>
				<span class="description customize-control-description"><?php echo $this->description; ?></span> 	
				<div class="image-selection-container">
					<span class="dbl-click-text">Double click on an image to zoom in</span>
					<?php foreach ( $this->images as $image_choice ) : ?>
					<?php $id = esc_attr( $input_id . '-radio-' . str_replace( '', '-', $image_choice["nice_name"] ) );?>
					<div class="image-choice" style="<?php if ( $this->max_width != '' ) echo "max-width: ".$this->max_width.';'; ?>">
						<input
							class="selection-with-image-input"
							id="<?php echo $id?>"
							type="radio" 
							<?php echo $describedby_attr; ?>
							value="<?php echo esc_attr( $image_choice["value"] ); ?>" 
							name="<?php echo esc_attr( $name ); ?>" 
							<?php $this->link(); ?>	
							<?php checked( $this->value(), $image_choice["nice_name"] ); ?>	
							aria-label="<?php echo $image_choice["nice_name"] ?>"
							title="<?php echo $image_choice["nice_name"] ?>"					
						/> 
						<div class="image-selection-image">
							<img class="zoom-in-available" for="<?php echo $id; ?>" src="<?php echo $image_choice["src"]; ?>">
						</div>
					</div>					
					<?php endforeach; ?>
				</div>
			</label>
			<?php
			
		}
	}

	/*TO ADD
	/***Option to not use zoom in
	/***Add the possibility to use MULTIPLE IMAGES per IMAGE CHOICE, and display a carousel on the 'zoom in' view, with all those images
	*/
	class WP_Color_Scheme_Control extends WP_Extended_Control {
		public $colors_schemes;
		
		public function __construct($manager, $id, $args = array())
		{
			parent::__construct($manager, $id, $args);
			
			$this->colors_schemes = $args["colors_schemes"];
		}
	
		public function render_content() {
			$name = '_customize-image-radio-' . $this->id;
			$input_id = '_customize-input-' . $this->id;
			$description_id = '_customize-description-' . $this->id;
			$describedby_attr = ( ! empty( $this->description ) ) ? ' aria-describedby="' . esc_attr( $description_id ) . '" ' : '';
			?>
			<label class="customize-control-color-schemes">
				<span class="customize-control-title"><?php echo $this->label; ?></span>
				<span class="description customize-control-description"><?php echo $this->description; ?></span> 	
				<div class="colors-scheme">
					<div class="color-scheme-container">
					<?php if ( empty($this->colors_schemes)) : ?>
						<p> No colors schemes where supplied </p>
					<?php else : ?>
						<?php foreach ( $this->colors_schemes as $scheme_value => $scheme_colors ) : ?>
						<div class="color-scheme">
							<input
								class="color-scheme-input"
								id="<?php echo $id?>"
								type="radio" 
								<?php echo $describedby_attr; ?>
								value="<?php echo esc_attr( $scheme_value ); ?>" 
								name="<?php echo esc_attr( $name ); ?>" 
								<?php $this->link(); ?>	
								<?php checked( $this->value(), $scheme_value ); ?>	
								aria-label="<?php echo $scheme_value ?>"
								title="<?php echo $scheme_value ?>"					
							/> 
							<?php foreach ( $scheme_colors as $color ) : ?>
							<div>
								<span style="background-color: <?php echo $color; ?>;"></span>
							</div>
							<?php endforeach; ?>
						</div>
						<?php endforeach; ?>
					<?php endif; ?>
					</div>					
				</div>
			</label>
			<?php	
		}
	}
	
	class WP_Sortable_List_Control extends WP_Extended_Control {
		/**
		*	Array with the list items. Ex:
		*		array(
		*			'value' => 'List item content',
		*		)		
		*	Commas on the 'value' will be replace with '-'
		*/
		public $items = array();
		public $current_value; 
		
		public function update_value(){
			$items_keys = array_keys ( $this->items );
			$current_order = $this->value() ? explode(',', $this->value()) : array();
			
			//Eliminates the items that are no longer in the items array

			foreach( $current_order as $item_key ){
				if ( !in_array ( $item_key, $items_keys ) )
					unset($current_order[ array_search ( $item_key, $current_order ) ]);
			}

			//Reindex the array ( unset deletes the element from the array but doesnt change the index of the rest)
			$current_order = array_values($current_order);
			
			//Push new items to the array
			foreach( $items_keys as $item_key ){
				if ( !in_array ( $item_key, $current_order ) )
					array_push ( $current_order, $item_key );
			}
			
			$this->current_value = $current_order;
			//print_r( $this->current_value );
		}
	
		public function array_replace_keys_commas( $strings, $replace_value = "-"){
			$temp_array = array_flip($strings);
			
			foreach( $temp_array as $item_key => $item_value )
				$temp_array[$item_key] = str_replace(",", $replace_value, $item_value);

			return array_flip($temp_array);
		}

		public function __construct($manager, $id, $args = array())
		{
			parent::__construct($manager, $id, $args);

			$this->items = $this->array_replace_keys_commas( $args["items"] );
			$this->update_value();
		}
	
		/**
		 * Render the control's content.
		 *
		 * @since 3.4.0
		*/	
		public function render_content() {
			$name = '_customize-sortable-list-' . $this->id;
			$input_id = '_customize-sortable-item' . $this->id;
			$description_id = '_customize-description-' . $this->id;
			$describedby_attr = ( ! empty( $this->description ) ) ? ' aria-describedby="' . esc_attr( $description_id ) . '" ' : '';
			$amount_of_items = count($this->items);
			$ordered_items_values = $this->current_value;

			?>
			<label class="customize-control-sortable-list">
				<span class="customize-control-title"><?php echo $this->label; ?></span>
				<span class="description customize-control-description"><?php echo $this->description; ?></span> 
				<ul class="sortables-ul">
					<?php
						for ( $i = 0; $i < $amount_of_items; $i++){
							$item_value = $ordered_items_values[$i];
							$item_nice_name = $this->items[$ordered_items_values[$i]];
							$id = esc_attr( $input_id . '-' . str_replace( '', '-', $item_value ) );
							?>
							<li 
								class="sortable-li" 
								id="<?php echo $id?>" 
								<?php echo $describedby_attr; ?> 
								name="<?php echo esc_attr( $item_value ); ?>"
							> 
								<?php echo $item_nice_name ?> 
							</li>
							<?php
						}
					?>
					<input type="hidden" value="<?php echo $this->value(); ?>" <?php $this->link(); ?>>
				</ul>
			</label>
			<?php  
		}
	}
		
	class WP_List_Generator_Control extends WP_Extended_Control {
		public $max_num_of_lists;
		public $button_content;
		public $lists = [ 
			"first_list" 	=> [ "List item 1", "List item 2"],
			"second_list" 	=> [ "List item 1", "List item 2"],
			"third_list" 	=> [ "List item 1", "List item 2"],
		];
		
		public function __construct($manager, $id, $args = array())
		{
			parent::__construct($manager, $id, $args);

			$this->max_num_of_lists = $args["max_num_of_lists"];
			$this->button_content = $args["button_content"];
		}
		
		public function get_list_ordered_json(){
			$list_json = json_encode($this->lists);
			return str_replace('"',"'",$list_json); 
		}
		
		public function sanitized_value(){
			return str_replace('"',"'",$this->setting->value());
		}
		
		public function decoded_value(){
			return json_decode ( $this->setting->value(), true );
		}
		
		public function the_lists(){
			$lists = $this->decoded_value();
			$index = 0;
			
			foreach ( $lists as $list){
				$list_name = $list["name"];
				$list_items = $list["items"];
				?>
				<li 
				data-list-name="<?php echo $list_name; ?>"  
				data-list-id="list_<?php echo $index; ?>" 
				data-list-items="<?php echo $this->stringify_items_array( $list_items ); ?>"
				class="sortable-li"
				>
					<span class="list-name"><?php echo $list_name; ?></span><i class="far fa-trash-alt delete-list" title="Delete List"></i>
				</li>
				<?php
				$index++;
			}
		}
		
		public function stringify_items_array( $items_array ){
			$array_length = count($items_array);
			$string = "";

			foreach ( $items_array as $index=>$item ){
				$string .= $item;
				if ( $index < ($array_length - 1) )
					$string .= ',';
			}
			
			return $string;
		}
		
		public function load_organize_lists_view(){
		?>
			<div class="lists-organization">
				<p>Organizate lists. Right click to edit that list</p>
				<div class="current-list">
					<ul class="sortables-ul">
						<!--
						<li data-list-name="First List"  data-list-id="list_1" data-list-items="BRANDING,NAMING ID,INSIGHTS AND DATA" class="sortable-li">
							<span class="list-name">First list</span><i class="far fa-trash-alt delete-list" title="Delete List"></i>
						</li>
						<li data-list-name="Second List"  data-list-id="list_2" data-list-items="li1" class="sortable-li">
							<span class="list-name">Second list</span><i class="far fa-trash-alt delete-list" title="Delete List"></i>
						</li>
						<li data-list-name="Third List"  data-list-id="list_3" data-list-items="li1,li2" class="sortable-li">
							<span class="list-name">Third list</span><i class="far fa-trash-alt delete-list" title="Delete List"></i>
						</li>
						-->
						<?php
							if ( !empty($this->value()) )
								$this->the_lists();
						?>						
						<input type="hidden" value="<?php echo $this->sanitized_value(); ?>" data-value="{'first_list':[],'second_list':[],'third_list':[]}" <?php $this->link(); ?>>
					</ul>
				</div>
				<div class="add-list">
					<i class="fas fa-plus-square" title="Add list"></i>
				</div>
			</div>
		<?php
		}

		public function load_edit_list_view(){
		?>
			<div data-list-id="" class="view-list" style="display: none;">
				<p> Editing list: <span class="the-list-name">name</span><i class="fas fa-pencil-alt edit-name"></i></p>
				<span> Right click to edit item content </span>
				<div class="current-list">
					<ul class="sortables-ul">
						<li class="sortable-li" >First item</li>
						<li class="sortable-li" >Second item</li>
						<li class="sortable-li" >Third item</li>
						<li class="sortable-li" >Forth item</li>
						<li class="sortable-li" >Fifth item</li>				
					</ul>
				</div>
				<div class="add-list-item">
					<i class="fas fa-plus-square" title="Add list item"></i>
				</div>
			</div>
		<?php
		}
		
		public function render_content() {
			?>
			<label class="customize-control-list-edition">
				<span class="customize-control-title"><?php echo $this->label; ?></span>
				<span class="description customize-control-description"><?php echo $this->description; ?></span> 
				<div class="list-edition-button">
					<span><?php echo $this->button_content; ?></span>
				</div>				
				<div class="list-edition-panel">
					<div class="panel-overlay"></div>
					<div class="lists-panel-title-container">
						<i class="fas fa-chevron-circle-left close-lists-panel-button"></i>
						<h5 class="list-edition-panel-title">Lists control panel</h5>
					</div>
					<span> Number of lists: <?php echo $this->max_num_of_lists; ?></span>
					<span> Maximum number of lists possible: 3</span>
					<div class="list-selection"> 
						<span class="organize-button active">Organize/select list</span>
					</div>
					<div class="lists-visualization">
						<?php $this->load_edit_list_view(); ?>
						<?php $this->load_organize_lists_view(); ?>
						<div class="insert-item-content ui-draggable">
							<h6> Editing list item </h6>
							<textarea class="item-edition-field"></textarea>
							<div class="item-edition-buttons awaiting-edition">
								<i class="far fa-save save-changes-button" title="Save changes"></i>
								<i class="far fa-trash-alt discard-changes-button" title="Discard changes"></i>
							</div>
						</div>
					</div>
				</div>
			</label>
			<?php  
		}
	}

	class WP_Textarea_Generator_Control extends WP_Extended_Control {
		
		public function get_items(){
			return json_decode ( $this->setting->value(), true );
		}
		
		public function print_item( $item_name ){
			?>
			<li class="sortable-li">
				<span class="draggable-ball"></span>
				<div class="collapsible-title">
					<div class="draggable-ball-space"></div>
					<span class="customize-control-arrow">
						<i class="fas fa-angle-down collapsible-arrow" aria-hidden="true"></i>
					</span>
					<span class="customize-control-title"><?php echo $item_name; ?></span><div class="customize-control-notifications-container" style="display: none;"><ul></ul></div> 
				</div>
				<div class="collapsible-body">
					<textarea class="textarea-generator-input"><?php echo $item_name; ?></textarea>
					<div class="collapsible-body-controls">
						<i class="fas fa-trash-alt delete-item"></i>
					</div>
				</div>					
			</li>		
			<?php
		}
		
		public function print_all_items(){
			$items = $this->get_items();
			foreach( $items as $item ){
				$this->print_item($item);
			}
		}
		
		
		public function render_content() {
			?>
			<label class="customize-control-textarea-generator">
				<span class="customize-control-title"><?php echo $this->label; ?></span>
				<span class="description customize-control-description"><?php echo $this->description; ?></span> 
				<ul class="textarea-generator-sortable-ul">
					<?php $this->print_all_items(); ?>			
				</ul>
				<div class="add-new-text">
					<i class="fas fa-plus"></i>
				</div>
				<input type="hidden" value="" <?php $this->link(); ?>>
			</label>
			<?php  
		}
	}
	
	//Loads a box with as many inputs as settings passed
	class WP_Social_Icons_Control extends WP_Extended_Control {
			public $type = 'social';
			
			public function load_setting_input( $key, $value ) {
                $value = '';
                if ( isset( $this->settings[ $key ] ) )
                    $value = $this->settings[ $key ]->value();				
			?>
				<label class="field-label"><?php echo $this->settings[ $key ]->pretty_name; ?></label>
				<input  <?php $this->link( $key ); ?> data-live-id="network" type="text" value="<?php echo $value["value"]; ?>" data-repeat-name="<?php echo $value["id"];?>" class="<?php echo $value["id"]; ?>" name="<?php echo $value["id"]; ?>"/>
			<?php
			}
			
            public function render_content() {
			?> <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span> 
				<div class="social-control" >
			<?php
				array_values ( $this->settings );
                foreach( $this->settings as $key => $value ) {
                    $this->load_setting_input( $key, $value );
                }
			?>
				</div>
			<?php
            }
	}	
	
	//Text editor control
	class Text_Editor_Custom_Control extends WP_Extended_Control{
		public $type = 'textarea';
		/**
		** Render the content on the theme customizer page
		*/
		public function render_content() { ?>
			<label>
			  <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			  <?php
				$settings = array(
					'textarea_name' 	=> $this->id,
					'media_buttons' 	=> false,
					'drag_drop_upload' 	=> false,
					'teeny'				=> true,
					'textarea_rows' 	=> 5,
				  );
				$this->filter_editor_setting_link();
				wp_editor($this->value(), $this->id, $settings );
			  ?>
			</label>
		<?php
			do_action('admin_footer');
			do_action('admin_print_footer_scripts');
		}
		private function filter_editor_setting_link() {
			add_filter( 'the_editor', function( $output ) { return preg_replace( '/<textarea/', '<textarea ' . $this->get_link(), $output, 1 ); } );
		}
	}

	//A control that supports multiple inputs controls, and agrupates them under one box
	//It needs an associative array of settings. The key will be the setting "nice name"; and the value will be the setting name
	//Settings array example:
	//	$menu_extra_item_settings = array ( 
	//		"Name" 	=> "menu-extra-item-name",
	//		"URL" 	=> "menu-extra-item-url", 
	//	);
	//
	class WP_Inputs_Container_Control extends WP_Extended_Control {
		public $type = 'container-control';
		public $general_title;

		public function load_setting_input( $key, $setting ) {
			$value = '';
			if ( isset( $this->settings[ $key ] ) )
				$value = $this->settings[ $key ]->value();				
		?>
			<label class="field-label"><?php echo $key; ?></label>
			<input  <?php $this->link( $key ); ?> data-live-id="network" type="text" value="<?php echo $value; ?>" data-repeat-name="<?php echo $value;?>" class="<?php echo $value; ?>" name="<?php echo $value; ?>"/>
		<?php
		}
		
		public function render_content() {
			//Title
			if ( !empty ( $this->general_title ) ) :
		?>
			<label class="customize-control-title general-title"><?php echo $this->general_title; ?></label>
		<?php endif;
			//Control description
			if ( !empty ( $this->description ) ) :
		?>
			<span class="description customize-control-description"><?php echo $this->description ?></span>	
		<?php endif; ?> 	
			<div class="title-holder">
				<span class="customize-control-arrow"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i></span>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span> 
			</div>
		<?php //INPUTS ?>
			<div class="input-container-control" >
		<?php
			array_values ( $this->settings );
			//$value = setting object
			foreach( $this->settings as $key => $value ) {
				//for every setting given, loads the input
				$this->load_setting_input( $key, $value );
			}
		?>
			</div>
		<?php
		}
	}	
	
	class WP_Inputs_Counter_Control extends WP_Extended_Control {
		/*  Display a counter on top an a series of inputs under it.
		/* The settings must be of Key => Value nature, beeing the
		/* key the label upon the input, and the value the setting id
		/* IMPORTANT!!!
		/* 		The counter setting KEY must be especified on the
		/* $counter of the control, in order to generate it. If not
		/*	provided, it will cause a FATAL ERROR
		**************************************************************/
		
		public $type = 'container-control'; //Type of control, this string will appear on the control HTML element as a class or classes
		public $counter; //REQUIRED, the counter setting id
		public $counter_settings = array ( //The counter settings, 'type' should not be change from number to be a counter
			'label'			=> '',
			'description'	=> '',
			'type'			=> 'number',
		);
		
		public function load_counter( ){
			?>
			<label>
				<?php if ( ! empty( $this->counter_settings['label'] ) ) : ?>
					<span class="customize-control-title"><?php echo esc_html( $this->counter_settings['label'] ); ?></span>
				<?php endif;
				if ( ! empty( $this->counter_settings['description'] ) ) : ?>
					<span class="description customize-control-description"><?php echo $this->counter_settings['description']; ?></span>
				<?php endif; ?>
				<input type="<?php echo esc_attr( $this->counter_settings['type'] ); ?>" <?php $this->input_attrs( $this->counter ); ?> value="<?php echo esc_attr( $this->value( $this->counter ) ); ?>" <?php $this->link( $this->counter ); ?> />
			</label>
			<?php
		}
		
		public function load_setting_input( $key, $setting ) {
			$value = '';
			if ( isset( $this->settings[ $key ] ) )
				$value = $this->settings[ $key ]->value();				
		?>
			<label class="field-label"><?php echo $key; ?></label>
			<input  <?php $this->link( $key ); ?> data-live-id="network" type="text" value="<?php echo $value; ?>" data-repeat-name="<?php echo $value;?>" class="<?php echo $value; ?>" name="<?php echo $value; ?>"/>
		<?php
		}
		
		public function render_content() {
			if( empty( $this->counter ) ){
				echo "<span style='color: red; font-weight: bold;'>Fatal error:</span> \$counter is not defined and expects a setting id to be use as a counter";
				return;
			}
		?> 	<div class="title-holder">
				<span class="customize-control-arrow"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i></span>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span> 
			</div>
			<div class="input-container-control" >
		<?php
			array_values ( $this->settings );
			//$value = setting object
			$this->load_counter();
			
			foreach( $this->settings as $key => $value ) {
				if ( $value->id == $this->counter )
					continue;
				$this->load_setting_input( $key, $value );
			}
		?>
			</div>
		<?php
		}
	}		
	