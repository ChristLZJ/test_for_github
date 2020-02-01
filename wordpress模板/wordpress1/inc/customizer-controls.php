<?php
class Dw_Resume_Customize_Repeatable_Control extends WP_Customize_Control {

		/**
		 * The type of customize control being rendered.
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    string
		 */
		public $type = 'repeatable';

		// public $fields = array();

		public $fields = array();
		public $live_title_id = null;
		public $title_format = null;
		public $defined_values = null;
		public $id_key = null;
		public $limited_msg = null;


		public function __construct( $manager, $id, $args = array() )
		{
			parent::__construct( $manager, $id, $args);
			if ( empty( $args['fields'] ) || ! is_array( $args['fields'] ) ) {
				$args['fields'] = array();
			}

			foreach ( $args['fields'] as $key => $op ) {
				$args['fields'][ $key ]['id'] = $key;
				if( ! isset( $op['value'] ) ) {
					if( isset( $op['default'] ) ) {
						$args['fields'][ $key ]['value'] = $op['default'];
					} else {
						$args['fields'][ $key ]['value'] = '';
					}
				}

			}

			$this->fields = $args['fields'];
			$this->live_title_id = isset( $args['live_title_id'] ) ? $args['live_title_id'] : false;
			$this->defined_values = isset( $args['defined_values'] ) ? $args['defined_values'] : false;
			$this->id_key = isset( $args['id_key'] ) ? $args['id_key'] : false;
			if ( isset( $args['title_format'] ) && $args['title_format'] != '' ) {
				$this->title_format = $args['title_format'];
			} else {
				$this->title_format = '';
			}

			if ( isset( $args['limited_msg'] ) && $args['limited_msg'] != '' ) {
				$this->limited_msg = $args['limited_msg'];
			} else {
				$this->limited_msg = '';
			}

			if ( ! isset( $args['max_item'] ) ) {
				$args['max_item'] = 0;
			}

			if ( ! isset( $args['allow_unlimited'] ) || $args['allow_unlimited'] != false ) {
				$this->max_item =  apply_filters( 'dw_resume_reepeatable_max_item', absint( $args['max_item'] ) );
			}  else {
				$this->max_item = absint( $args['max_item'] );
			}

			$this->changeable =  isset(  $args['changeable'] ) && $args['changeable'] == 'no' ? 'no' : 'yes';
			$this->default_empty_title =  isset(  $args['default_empty_title'] ) && $args['default_empty_title'] != '' ? $args['default_empty_title'] : esc_html__( 'Item', 'dw-resume' );

		}

		public function merge_data( $array_value, $array_default ){

			if ( ! $this->id_key ) {
				return $array_value;
			}

			if ( ! is_array( $array_value ) ) {
				$array_value =  array();
			}

			if ( ! is_array( $array_default ) ) {
				$array_default =  array();
			}

			$new_array = array();
			foreach ( $array_value as $k => $a ) {

				if ( is_array( $a ) ) {
					if ( isset ( $a[ $this->id_key ]  ) && $a[ $this->id_key ] != '' ) {
						$new_array[ $a[ $this->id_key ] ] = $a;
					} else {
						$new_array[ $k ] = $a;
					}
				}
			}

			foreach ( $array_default as $k => $a ) {
				if ( is_array( $a ) && isset ( $a[ $this->id_key ]  ) ) {
					if ( ! isset ( $new_array[ $a[ $this->id_key ] ] ) ) {
						$new_array[ $a[ $this->id_key ] ] = $a;
					}
				}
			}

			return array_values( $new_array );
		}

		public function to_json() {
			parent::to_json();
			$value = $this->value();
			if ( empty ( $value ) ){
				$value = json_encode( $this->defined_values );
			} elseif ( is_array( $this->defined_values ) && ! empty ( $this->defined_values ) ) {
				$value = json_decode( $value, true );
				$value = $this->merge_data( $value, $this->defined_values );
				$value = json_encode( $value );
			}

			$this->json['live_title_id'] = $this->live_title_id;
			$this->json['title_format']  = $this->title_format;
			$this->json['max_item']      = $this->max_item;
			$this->json['limited_msg']   = $this->limited_msg;
			$this->json['changeable']    = $this->changeable;
			$this->json['default_empty_title']    = $this->default_empty_title;
			$this->json['value']         = $value;
			$this->json['id_key']        = $this->id_key;
			$this->json['fields']        = $this->fields;

		}

		/**
		 * Enqueue scripts/styles.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function enqueue() {

			wp_enqueue_media();

			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_style( 'wp-color-picker' );

			wp_register_script( 'dw-resume-customizer', get_template_directory_uri() . '/assets/js/customize.js', array( 'customize-controls', 'wp-color-picker' ) );
			wp_register_style( 'dw-resume-customizer',  get_template_directory_uri() . '/assets/css/customize.css' );

			wp_enqueue_script( 'dw-resume-customizer' );
			wp_enqueue_style( 'dw-resume-customizer' );

			if ( ! class_exists( '_WP_Editors' ) ) {
				require(ABSPATH . WPINC . '/class-wp-editor.php');
			}

			add_action( 'customize_controls_print_footer_scripts', array( __CLASS__, 'enqueue_editor' ),  2 );
			add_action( 'customize_controls_print_footer_scripts', array( '_WP_Editors', 'editor_js' ), 50 );
			add_action( 'customize_controls_print_footer_scripts', array( '_WP_Editors', 'enqueue_scripts' ), 1 );

		}

		public  static function enqueue_editor(){
			if( ! isset( $GLOBALS['__wp_mce_editor__'] ) || ! $GLOBALS['__wp_mce_editor__'] ) {
				$GLOBALS['__wp_mce_editor__'] = true;
				?>
				<script id="_wp-mce-editor-tpl" type="text/html">
				<?php wp_editor('', '__wp_mce_editor__'); ?>
				</script>
				<?php
			}
		}

		public function render_content() {

			?>
			<label>
				<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>
			<?php if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
		<?php endif; ?>
	</label>

	<input data-hidden-value type="hidden" <?php $this->input_attrs(); ?> value="" <?php $this->link(); ?> />

	<div class="form-data">
		<ul class="list-repeatable">
		</ul>
	</div>

	<div class="repeatable-actions">
		<span class="button-secondary add-new-repeat-item"><?php _e( 'Add an item', 'dw-resume' ); ?></span>
	</div>

	<script type="text/html" class="repeatable-js-template">
	<?php $this->js_item(); ?>
	</script>
	<?php
}

public function js_item( ){

	?>
	<li class="repeatable-customize-control">
		<div class="widget">
			<div class="widget-top">
				<div class="widget-title-action">
					<a class="widget-action" href="#"></a>
				</div>
				<div class="widget-title">
					<h4 class="live-title"><?php _e( 'Item', 'dw-resume' ); ?></h4>
				</div>
			</div>

			<div class="widget-inside">
				<div class="form">
					<div class="widget-content">
						<# var cond_v; #>
						<# for ( i in data ) { #>
						<# if ( ! data.hasOwnProperty( i ) ) continue; #>
						<# field = data[i]; #>
						<# if ( ! field.type ) continue; #>


						<# if ( field.type ){ #>

						<#
						if ( field.required  && field.required.length >= 3 ) {
						#>
						<div class="conditionize item item-{{ field.type }} item-{{ field.id }}" data-cond-option="{{ field.required[0] }}" data-cond-operator="{{ field.required[1] }}" data-cond-value="{{ field.required[2] }}" >
							<#
						} else {
						#>
						<div class="item item-{{ field.type }} item-{{ field.id }}" >
							<#
						}
						#>
						<# if ( field.type !== 'checkbox' ) { #>
						<# if ( field.title ) { #>
						<label class="field-label">{{ field.title }}</label>
						<# } #>

						<# if ( field.desc ) { #>
						<p class="field-desc description">{{{ field.desc }}}</p>
						<# } #>
						<# } #>


						<# if ( field.type === 'hidden' ) { #>
						<input data-live-id="{{ field.id }}" type="hidden" value="{{ field.value }}" data-repeat-name="_items[__i__][{{ field.id }}]" class="">
						<# } else if ( field.type === 'add_by' ) { #>
						<input data-live-id="{{ field.id }}" type="hidden" value="{{ field.value }}" data-repeat-name="_items[__i__][{{ field.id }}]" class="add_by">
						<# } else if ( field.type === 'text' ) { #>
						<input data-live-id="{{ field.id }}" type="text" value="{{ field.value }}" data-repeat-name="_items[__i__][{{ field.id }}]" class="">
						<# } else if ( field.type === 'checkbox' ) { #>

						<# if ( field.title ) { #>
						<label class="checkbox-label">
							<input data-live-id="{{ field.id }}" type="checkbox" <# if ( field.value ) { #> checked="checked" <# } #> value="1" data-repeat-name="_items[__i__][{{ field.id }}]" class="">
							{{ field.title }}</label>
							<# } #>

							<# if ( field.desc ) { #>
							<p class="field-desc description">{{ field.desc }}</p>
							<# } #>


							<# } else if ( field.type === 'select' ) { #>

							<# if ( field.multiple ) { #>
							<select data-live-id="{{ field.id }}"  class="select-multiple" multiple="multiple" data-repeat-name="_items[__i__][{{ field.id }}][]">
								<# } else  { #>
								<select data-live-id="{{ field.id }}"  class="select-one" data-repeat-name="_items[__i__][{{ field.id }}]">
									<# } #>

									<# for ( k in field.options ) { #>

									<# if ( _.isArray( field.value ) ) { #>
									<option <# if ( _.contains( field.value , k ) ) { #> selected="selected" <# } #>  value="{{ k }}">{{ field.options[k] }}</option>
									<# } else { #>
									<option <# if ( field.value == k ) { #> selected="selected" <# } #>  value="{{ k }}">{{ field.options[k] }}</option>
									<# } #>

									<# } #>

								</select>

								<# } else if ( field.type === 'radio' ) { #>

								<# for ( k in field.options ) { #>

								<# if ( field.options.hasOwnProperty( k ) ) { #>

								<label>
									<input data-live-id="{{ field.id }}"  type="radio" <# if ( field.value == k ) { #> checked="checked" <# } #> value="{{ k }}" data-repeat-name="_items[__i__][{{ field.id }}]" class="widefat">
									{{ field.options[k] }}
								</label>

								<# } #>
								<# } #>

								<# } else if ( field.type == 'color' || field.type == 'coloralpha'  ) { #>

								<# if ( field.value !='' ) { field.value = '#'+field.value ; }  #>

								<input data-live-id="{{ field.id }}" data-show-opacity="true" type="text" value="{{ field.value }}" data-repeat-name="_items[__i__][{{ field.id }}]" class="color-field c-{{ field.type }} alpha-color-control">

								<# } else if ( field.type == 'media' ) { #>

								<# if ( !field.media  || field.media == '' || field.media =='image' ) {  #>
								<input type="hidden" value="{{ field.value.url }}" data-repeat-name="_items[__i__][{{ field.id }}][url]" class="image_url widefat">
								<# } else { #>
								<input type="text" value="{{ field.value.url }}" data-repeat-name="_items[__i__][{{ field.id }}][url]" class="image_url widefat">
								<# } #>
								<input type="hidden" data-live-id="{{ field.id }}"  value="{{ field.value.id }}" data-repeat-name="_items[__i__][{{ field.id }}][id]" class="image_id widefat">

								<# if ( !field.media  || field.media == '' || field.media =='image' ) {  #>
								<div class="current <# if ( field.value.url !== '' ){ #> show <# } #>">
									<div class="container">
										<div class="attachment-media-view attachment-media-view-image landscape">
											<div class="thumbnail thumbnail-image">
												<# if ( field.value.url !== '' ){ #>
												<img src="{{ field.value.url }}" alt="">
												<# } #>
											</div>
										</div>
									</div>
								</div>
								<# } #>

								<div class="actions">
									<button class="button remove-button " <# if ( ! field.value.url ){ #> style="display:none"; <# } #> type="button"><?php _e( 'Remove', 'dw-resume' ) ?></button>
									<button class="button upload-button" data-media="{{field.media}}" data-add-txt="<?php esc_attr_e( 'Add', 'dw-resume' ); ?>" data-change-txt="<?php esc_attr_e( 'Change', 'dw-resume' ); ?>" type="button"><# if ( ! field.value.url  ){ #> <?php _e( 'Add', 'dw-resume' ); ?> <# } else { #> <?php _e( 'Change', 'dw-resume' ); ?> <# } #> </button>
									<div style="clear:both"></div>
								</div>

								<# } else if ( field.type == 'textarea' || field.type == 'editor' ) { #>

								<textarea data-live-id="{{{ field.id }}}" data-repeat-name="_items[__i__][{{ field.id }}]">{{ field.value }}</textarea>

								<# } #>

							</div>


							<# } #>
							<# } #>


							<div class="widget-control-actions">
								<div class="alignleft">
									<span class="remove-btn-wrapper">
										<a href="#" class="repeat-control-remove" title=""><?php _e( 'Remove', 'dw-resume' ); ?></a> |
									</span>
									<a href="#" class="repeat-control-close"><?php _e( 'Close', 'dw-resume' ); ?></a>
								</div>
								<br class="clear">
							</div>

						</div>
					</div><!-- .form -->

				</div>

			</div>
		</li>
		<?php

	}

}

class DwResume_Editor_Custom_Control extends WP_Customize_Control {

	public $type = 'wp_editor';
	public $mod;

	public function enqueue() {
		wp_enqueue_script( 'wp-color-picker' );
		wp_register_script( 'dw-resume-customizer', get_template_directory_uri() . '/assets/js/customize.js', array( 'customize-controls', 'wp-color-picker' ) );
		wp_register_style( 'dw-resume-customizer',  get_template_directory_uri() . '/assets/css/customize.css' );

		wp_enqueue_script( 'dw-resume-customizer' );
		wp_enqueue_style( 'dw-resume-customizer' );


		if ( ! class_exists( '_WP_Editors' ) ) {
			require(ABSPATH . WPINC . '/class-wp-editor.php');
		}

		add_action( 'customize_controls_print_footer_scripts', array( __CLASS__, 'enqueue_editor' ),  2 );
		add_action( 'customize_controls_print_footer_scripts', array( '_WP_Editors', 'editor_js' ), 50 );
		add_action( 'customize_controls_print_footer_scripts', array( '_WP_Editors', 'enqueue_scripts' ), 1 );
	}

	public  static function enqueue_editor(){
		if( ! isset( $GLOBALS['__wp_mce_editor__'] ) || ! $GLOBALS['__wp_mce_editor__'] ) {
			$GLOBALS['__wp_mce_editor__'] = true;
			?>
			<script id="_wp-mce-editor-tpl" type="text/html">
			<?php wp_editor('', '__wp_mce_editor__'); ?>
			</script>
			<?php
		}
	}
	public function render_content() {
		$this->mod = strtolower( $this->mod );
		if( ! $this->mod = 'html' ) {
			$this->mod = 'tmce';
		}
		?>
		<div class="wp-js-editor">
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			</label>
			<textarea class="wp-js-editor-textarea large-text" data-editor-mod="<?php echo esc_attr( $this->mod ); ?>" cols="20" rows="5" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
			<p class="description"><?php echo $this->description ?></p>
		</div>
		<?php
	}
}

class DwResume_Icon_Custom_Control extends WP_Customize_Control {

	public $type = 'icon';

	public function enqueue() {
		wp_enqueue_script( 'icon-picker', get_template_directory_uri() . '/assets/js/jquery.fonticonpicker.js' );
		wp_enqueue_style( 'icon-picker', get_template_directory_uri() . '/assets/css/jquery.fonticonpicker.css' );
		wp_enqueue_style( 'icon-picker-grey', get_template_directory_uri() . '/assets/css/jquery.fonticonpicker.grey.min.css' );
		wp_enqueue_style( 'icon-7-stroke', get_template_directory_uri() . '/assets/css/pe-icon-7-stroke.css' );
	}

	public function render_content() {
		?>

		<script>jQuery(document).ready( function($) {
			$('#<?php echo $this->id; ?>').fontIconPicker({
				source:    ['pe-7s-album','pe-7s-arc','pe-7s-back-2','pe-7s-bandaid','pe-7s-car','pe-7s-diamond','pe-7s-door-lock','pe-7s-eyedropper','pe-7s-female','pe-7s-gym','pe-7s-hammer','pe-7s-headphones','pe-7s-helm','pe-7s-hourglass','pe-7s-leaf','pe-7s-magic-wand','pe-7s-male','pe-7s-map-2','pe-7s-next-2','pe-7s-paint-bucket','pe-7s-pendrive','pe-7s-photo','pe-7s-piggy','pe-7s-plugin','pe-7s-refresh-2','pe-7s-rocket','pe-7s-settings','pe-7s-shield','pe-7s-smile','pe-7s-usb','pe-7s-vector','pe-7s-wine','pe-7s-cloud-upload','pe-7s-cash','pe-7s-close','pe-7s-bluetooth','pe-7s-cloud-download','pe-7s-way','pe-7s-close-circle','pe-7s-id','pe-7s-angle-up','pe-7s-wristwatch','pe-7s-angle-up-circle','pe-7s-world','pe-7s-angle-right','pe-7s-volume','pe-7s-angle-right-circle','pe-7s-users','pe-7s-angle-left','pe-7s-user-female','pe-7s-angle-left-circle','pe-7s-up-arrow','pe-7s-angle-down','pe-7s-switch','pe-7s-angle-down-circle','pe-7s-scissors','pe-7s-wallet','pe-7s-safe','pe-7s-volume2','pe-7s-volume1','pe-7s-voicemail','pe-7s-video','pe-7s-user','pe-7s-upload','pe-7s-unlock','pe-7s-umbrella','pe-7s-trash','pe-7s-tools','pe-7s-timer','pe-7s-ticket','pe-7s-target','pe-7s-sun','pe-7s-study','pe-7s-stopwatch','pe-7s-star','pe-7s-speaker','pe-7s-signal','pe-7s-shuffle','pe-7s-shopbag','pe-7s-share','pe-7s-server','pe-7s-search','pe-7s-film','pe-7s-science','pe-7s-disk','pe-7s-ribbon','pe-7s-repeat','pe-7s-refresh','pe-7s-add-user','pe-7s-refresh-cloud','pe-7s-paperclip','pe-7s-radio','pe-7s-note2','pe-7s-print','pe-7s-network','pe-7s-prev','pe-7s-mute','pe-7s-power','pe-7s-medal','pe-7s-portfolio','pe-7s-like2','pe-7s-plus','pe-7s-left-arrow','pe-7s-play','pe-7s-key','pe-7s-plane','pe-7s-joy','pe-7s-photo-gallery','pe-7s-pin','pe-7s-phone','pe-7s-plug','pe-7s-pen','pe-7s-right-arrow','pe-7s-paper-plane','pe-7s-delete-user','pe-7s-paint','pe-7s-bottom-arrow','pe-7s-notebook','pe-7s-note','pe-7s-next','pe-7s-news-paper','pe-7s-musiclist','pe-7s-music','pe-7s-mouse','pe-7s-more','pe-7s-moon','pe-7s-monitor','pe-7s-micro','pe-7s-menu','pe-7s-map','pe-7s-map-marker','pe-7s-mail','pe-7s-mail-open','pe-7s-mail-open-file','pe-7s-magnet','pe-7s-loop','pe-7s-look','pe-7s-lock','pe-7s-lintern','pe-7s-link','pe-7s-like','pe-7s-light','pe-7s-less','pe-7s-keypad','pe-7s-junk','pe-7s-info','pe-7s-home','pe-7s-help2','pe-7s-help1','pe-7s-graph3','pe-7s-graph2','pe-7s-graph1','pe-7s-graph','pe-7s-global','pe-7s-gleam','pe-7s-glasses','pe-7s-gift','pe-7s-folder','pe-7s-flag','pe-7s-filter','pe-7s-file','pe-7s-expand1','pe-7s-exapnd2','pe-7s-edit','pe-7s-drop','pe-7s-drawer','pe-7s-download','pe-7s-display2','pe-7s-display1','pe-7s-diskette','pe-7s-date','pe-7s-cup','pe-7s-culture','pe-7s-crop','pe-7s-credit','pe-7s-copy-file','pe-7s-config','pe-7s-compass','pe-7s-comment','pe-7s-coffee','pe-7s-cloud','pe-7s-clock','pe-7s-check','pe-7s-chat','pe-7s-cart','pe-7s-camera','pe-7s-call','pe-7s-calculator','pe-7s-browser','pe-7s-box2','pe-7s-box1','pe-7s-bookmarks','pe-7s-bicycle','pe-7s-bell','pe-7s-battery','pe-7s-ball','pe-7s-back','pe-7s-attention','pe-7s-anchor','pe-7s-albums','pe-7s-alarm','pe-7s-airplay' ],
				emptyIcon: false,

			}).on('change', function() {

				var selectedIcon = $(this).val();
				$('#<?php echo $this->id; ?>').val( selectedIcon );

			});
		});

		</script>
		<div class="icon-custom-control">
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			</label>
			<input data-customize-setting-link="dw_resume_theme_options[<?php echo $this->id; ?>]" type="text" name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>" />
			<p class="description"><?php echo $this->description ?></p>
		</div>
		<?php
	}
}

function dw_resume_sanitize_text( $value ) {
	return wp_kses_post( balanceTags( $value ) );
}

function dw_resume_sanitize_number( $int ) {
	return absint( $int );
}

function dw_resume_return_value( $value ) {
	if ( '' != $value ) {
		return $value;
	} else {
		return '';
	}
}

function dw_resume_sanitize_file_url( $url ) {
	$output = '';
	$filetype = wp_check_filetype( $url );
	if ( $filetype['ext'] ) {
		$output = esc_url( $url );
	}
	return $output;
}

function dw_resume_sanitize_checkbox( $value ) {
	if ( $value == 1 ) {
		return 1;
	} else {
		return 0;
	}
}



function dw_resume_sanitize_repeatable_data_field( $input , $setting ){
	$control = $setting->manager->get_control( $setting->id );

	$fields = $control->fields;
	$input = json_decode( $input , true );
	$data = wp_parse_args( $input, array() );

	if ( ! is_array( $data ) ) {
		return false;
	}
	if ( ! isset( $data['_items'] ) ) {
		return  false;
	}
	$data = $data['_items'];

	foreach( $data as $i => $item_data ){
		foreach( $item_data as $id => $value ){

			if ( isset( $fields[ $id ] ) ){
				switch( strtolower( $fields[ $id ]['type'] ) ) {
					case 'text':
					$data[ $i ][ $id ] = sanitize_text_field( $value );
					break;
					case 'textarea':
					$data[ $i ][ $id ] = wp_kses_post( $value );
					break;
					case 'color':
					$data[ $i ][ $id ] = sanitize_hex_color_no_hash( $value );
					break;
					case 'coloralpha':
					$data[ $i ][ $id ] = onepress_sanitize_color_alpha( $value );
					break;
					case 'checkbox':
					$data[ $i ][ $id ] =  onepress_sanitize_checkbox( $value );
					break;
					case 'select':
					$data[ $i ][ $id ] = '';
					if ( is_array( $fields[ $id ]['options'] ) && ! empty( $fields[ $id ]['options'] ) ){
														// if is multiple choices
						if ( is_array( $value ) ) {
							foreach ( $value as $k => $v ) {
								if ( isset( $fields[ $id ]['options'][ $v ] ) ) {
									$value [ $k ] =  $v;
								}
							}
							$data[ $i ][ $id ] = $value;
						} else { // is single choice
							if (  isset( $fields[ $id ]['options'][ $value ] ) ) {
								$data[ $i ][ $id ] = $value;
							}
						}
					}

					break;
					case 'radio':
					$data[ $i ][ $id ] = sanitize_text_field( $value );
					break;
					case 'media':
					$value = wp_parse_args( $value,
						array(
							'url' => '',
							'id'=> false
							)
						);
					$value['id'] = absint( $value['id'] );
					$data[ $i ][ $id ]['url'] = sanitize_text_field( $value['url'] );

					if ( $url = wp_get_attachment_url( $value['id'] ) ) {
						$data[ $i ][ $id ]['id']   = $value['id'];
						$data[ $i ][ $id ]['url']  = $url;
					} else {
						$data[ $i ][ $id ]['id'] = '';
					}

					break;
					default:
					$data[ $i ][ $id ] = wp_kses_post( $value );
				}

			}else {
				$data[ $i ][ $id ] = wp_kses_post( $value );
			}

			if ( count( $data[ $i ] ) !=  count( $fields ) ) {
				foreach ( $fields as $k => $f ){
					if ( ! isset( $data[ $i ][ $k ] ) ) {
						$data[ $i ][ $k ] = '';
					}
				}
			}

		}

	}

	return json_encode( $data );
}



