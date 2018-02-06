<?php
/*
*
*	Custom customizer settings
*
*/
	class WP_Social_Setting extends WP_Customize_Setting {
		
		public static $all_social_settings = array();
		
		function __construct($name, $type, $age) {
			self::$all_social_settings[] = $this;
			parent::__construct($name, $type, $age);
		}	
		
		public $font_aweasome_code; //Icon code, taken from http://fontawesome.io
		public $size = "fa-lg"; //Icon size, accepts fa-lg, fa-2x, fa-3x, fa-4x, fa-5x
		public $pretty_name; //Name to dispaly as title for the control on the customizer
		public $control_id; //Controler ID where the settings are supposed to go
		
		public static function get_all_settings_by_control ($control){
			$all_social_settings_by_control = array();
			$social_settings = self::$all_social_settings;
			
			foreach ($social_settings as $social_setting)
				if ($social_setting->control_id == $control)
					array_push ( $all_social_settings_by_control, $social_setting );
			
			return $all_social_settings_by_control;			
		}
		
		public function js_value() {
	 
			/**
			 * Filters a Customize setting value for use in JavaScript.
			 *
			 * The dynamic portion of the hook name, `$this->id`, refers to the setting ID.
			 *
			 * @since 3.4.0
			 *
			 * @param mixed                $value The setting value.
			 * @param WP_Customize_Setting $this  WP_Customize_Setting instance.
			 */
			$value = apply_filters( "customize_sanitize_js_{$this->id}", $this->value()["value"], $this );
	 
			if ( is_string( $value ) )
				return html_entity_decode( $value, ENT_QUOTES, 'UTF-8');
	 
			return $value;
		}		
		
		public function value(){
			$value = parent::value();
			$values = array( 
				"value"					=> $value,
				"font_aweasome_code"	=> $this->font_aweasome_code,
				"size"					=> $this->size,
				"pretty_name"			=> $this->pretty_name,
				"control_id"			=> $this->control_id 
			);
			return $values;
		}
	}
?>
