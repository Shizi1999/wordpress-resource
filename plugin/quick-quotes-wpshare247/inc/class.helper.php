<?php
if( !class_exists('Wp247_quote_qqfs_Helper') ):
	
	class Wp247_quote_qqfs_Helper{
		/**
		 * Constructor
		 */
		function __construct() {
			add_action( 'wp_ajax_ws247_quote_qqfs_add_option', array( $this, 'ws247_quote_qqfs_add_option' ) ); 
        	add_action( 'wp_ajax_nopriv_ws247_quote_qqfs_add_option', array( $this, 'ws247_quote_qqfs_add_option' ) );
			
			add_action( 'wp_ajax_ws247_quote_qqfs_del_option', array( $this, 'ws247_quote_qqfs_del_option' ) ); 
        	add_action( 'wp_ajax_nopriv_ws247_quote_qqfs_del_option', array( $this, 'ws247_quote_qqfs_del_option' ) );
			
			add_action( 'wp_ajax_ws247_create_quote_qqfs_sortable', array( $this, 'ws247_create_quote_qqfs_sortable' ) ); 
        	add_action( 'wp_ajax_nopriv_ws247_create_quote_qqfs_sortable', array( $this, 'ws247_create_quote_qqfs_sortable' ) );
			
			add_action( 'wp_ajax_ws247_quote_qqfs_start', array( $this, 'ws247_quote_qqfs_start' ) ); 
        	add_action( 'wp_ajax_nopriv_ws247_quote_qqfs_start', array( $this, 'ws247_quote_qqfs_start' ) );
			
			add_action( 'wp_ajax_ws247_quote_qqfs_checkbox_req', array( $this, 'ws247_quote_qqfs_checkbox_req' ) ); 
        	add_action( 'wp_ajax_nopriv_ws247_quote_qqfs_checkbox_req', array( $this, 'ws247_quote_qqfs_checkbox_req' ) );
			
			add_action( 'wp_ajax_ws247_quote_qqfs_checkbox_sortcontainer', array( $this, 'ws247_quote_qqfs_checkbox_sortcontainer' ) ); 
        	add_action( 'wp_ajax_nopriv_ws247_quote_qqfs_checkbox_sortcontainer', array( $this, 'ws247_quote_qqfs_checkbox_sortcontainer' ) );
			
			add_action( 'wp_ajax_ws247_quote_qqfs_btn_save_form', array( $this, 'ws247_quote_qqfs_btn_save_form' ) ); 
        	add_action( 'wp_ajax_nopriv_ws247_quote_qqfs_btn_save_form', array( $this, 'ws247_quote_qqfs_btn_save_form' ) );
		}
		
		
		/*
		Get html template
		Call: self::get_template_part('setting', 'page',true);
		*/
		public static function get_template_part($template_name, $part_name=null, $echo=true) {
			if($part_name){
				$template_name = $template_name.'-'.$part_name;
			}
			$template_name = WS247_QUOTE_QQFS_PLUGIN_INC_TEMPLATES_DIR . '/' .$template_name.'.php';
			if( !file_exists($template_name) ) return '';
			
			$require_once = false;
			
			if($echo){ 
				load_template( $template_name, $require_once );
			}else{
				ob_start();
					load_template( $template_name, $require_once );
					$var = ob_get_contents();
				ob_end_clean();
				return $var;
			}
		}
		
		public function ws247_quote_qqfs_add_option(){
			header("Content-Type: application/json", true);
			
			$qqfs_options_field = Ws247_quote_qqfs::get_qqfs_options_field();
			$err = '';
			//_REQUEST
			$option_title = sanitize_text_field($_REQUEST['option_title']);
			if(!$option_title){
				$response['err'] = __("Title is a required field", WS247_QUOTE_QQFS_TEXTDOMAIN);
				wp_send_json($response);
			}
			
			//_DO ACTION
			if($option_title){
				$arr_qqfs_options = Ws247_quote_qqfs::get_qqfs_options();
				if(!is_array($arr_qqfs_options)){ $arr_qqfs_options = array(); }
				$arr_qqfs_options[ 'qqfs_'.time() ] =  $option_title;
				
				update_option( $qqfs_options_field, $arr_qqfs_options ); 
			}
			
			//_RESPONSE
			$response = array	(
									'arr_qqfs_options' => Ws247_quote_qqfs::get_qqfs_options()
								);
			wp_send_json($response);
		}
		
		
		public function ws247_quote_qqfs_del_option(){
			header("Content-Type: application/json", true);
			
			$qqfs_options_field = Ws247_quote_qqfs::get_qqfs_options_field();
			$is_del = 0;
			//_REQUEST
			$qqfs_id = sanitize_text_field($_REQUEST['qqfs_id']);
			
			//_DO ACTION
			$arr_qqfs_options = Ws247_quote_qqfs::get_qqfs_options();
			if($arr_qqfs_options){
				if( array_key_exists($qqfs_id, $arr_qqfs_options) ){
					unset($arr_qqfs_options[$qqfs_id]);
					update_option( $qqfs_options_field, $arr_qqfs_options );
					$is_del = 1;
				}
			}
			
			//_RESPONSE
			$response = array	(
									'is_del' => $is_del
								);
			wp_send_json($response);
		}
		
		
		public function ws247_create_quote_qqfs_sortable(){
			header("Content-Type: application/json", true);

			$is_update = 0;
			//_REQUEST
			$s_order = sanitize_text_field($_REQUEST['s_order']);
			$postid = absint( wp_unslash($_REQUEST['postid']) );
			
			//_DO ACTION
			if($postid){
				update_post_meta( $postid, 'quote_qqfs_pt_step', $s_order );
				$is_update = 1;
			}
			
			
			//_RESPONSE
			$response = array	(
									'is_update' => $is_update
								);
			wp_send_json($response);
		}
		
		public function ws247_quote_qqfs_checkbox_req(){
			header("Content-Type: application/json", true);

			//_REQUEST
			$pt_type = sanitize_text_field($_REQUEST['pt_type']);
			$is_check = absint( wp_unslash($_REQUEST['is_check']) );
			
			//_DO ACTION
			update_option( 'req_'.$pt_type, $is_check );
			
			//_RESPONSE
			$response = array	(
									'is_update' => 1
								);
			wp_send_json($response);
		}
		
		public function ws247_quote_qqfs_checkbox_sortcontainer(){
			header("Content-Type: application/json", true);

			//_REQUEST
			$pt_type = sanitize_text_field($_REQUEST['pt_type']);
			$is_check = absint( wp_unslash($_REQUEST['is_check']) );
			
			//_DO ACTION
			update_option( $pt_type, $is_check );
			
			//_RESPONSE
			$response = array	(
									'is_update' => 1
								);
			wp_send_json($response);
		}
		
		public static function step_save($s_post_type, $list_ids){ 
			if( isset($_SESSION['ws247_quote_qqfs_steps']) ){
				$arr_save = $_SESSION['ws247_quote_qqfs_steps'];
				$arr_save[$s_post_type] = $list_ids;
				$_SESSION['ws247_quote_qqfs_steps'] = $arr_save;
			}else{
				$_SESSION['ws247_quote_qqfs_steps'] = array($s_post_type => $list_ids);
			}
		}
		
		public static function get_step_save(){
			if( isset($_SESSION['ws247_quote_qqfs_steps']) ){
				return $_SESSION['ws247_quote_qqfs_steps'];
			}
			return false;
		}
		
		public static function step_empty(){
			unset($_SESSION['ws247_quote_qqfs_steps']);
		}
		
		public function ws247_quote_qqfs_start(){
			header("Content-Type: application/json", true);
			
			$error = 0; $html = ''; $btn_next_text = ''; $btn_reset = ''; $is_req = 0; $step_title = '';
			
			//_REQUEST
			$quoteid = absint( wp_unslash($_REQUEST['quoteid']) );
			$i_step = absint( wp_unslash($_REQUEST['i_step']) );
			$list_ids = sanitize_text_field($_REQUEST['list_ids']);
			
			//_DO ACTION
			if( get_post_status( $quoteid ) != 'publish' ){
				wp_send_json(array('error'=>1, 'mes'=>__('Quote does not exist', WS247_QUOTE_QQFS_TEXTDOMAIN)));
			}
			
			$s_quote_qqfs_pt_step = get_post_meta($quoteid, 'quote_qqfs_pt_step', true);
			$arr_quote_qqfs_pt_step = array();
			if($s_quote_qqfs_pt_step){
				$arr_quote_qqfs_pt_step = explode(",", $s_quote_qqfs_pt_step);
			}
			
			if(empty($arr_quote_qqfs_pt_step)){
				wp_send_json(array('error'=>1, 'mes'=>__('This quote currently has no steps (Option). Please go to admin for more steps to create a quote.', WS247_QUOTE_QQFS_TEXTDOMAIN)));
			}
			if($i_step){
				self::step_save($arr_quote_qqfs_pt_step[$i_step-1], $list_ids);
			}else{
				self::step_empty();
			}
		
			$s_post_type = $arr_quote_qqfs_pt_step[$i_step];
			if($s_post_type){
				$arr_qqfs_options = Ws247_quote_qqfs::get_qqfs_options();
				$step_title = $arr_qqfs_options[$s_post_type]; 
				
				$args_filter = array(
					'post_type' => array($s_post_type), 
					'post_status' => array('publish'),
					'posts_per_page' => -1,
					'orderby'             => 'date', 
					'order'                => 'asc'
				);
				$the_query = new WP_query($args_filter);
				$checkbox_type = '';
				if($the_query->have_posts()):
					$checkbox_group = uniqid('quote-qqfs-choose-one-');
					$is_choose_one = get_option($s_post_type);
					if($is_choose_one){
						$checkbox_type = 'quote-qqfs-choose-one';
					}
					
					$is_req = get_option('req_'.$s_post_type);
					
					ob_start();
					?>
                    <div class="qqfs-12"><span class="step-title qqfs-center"><?php echo esc_attr($step_title);?></span></div>
                    <?php
					$col = 'qqfs-md-4';
					$count = $the_query->found_posts;
					if($count==1){
						$col = 'qqfs-md-12';
					}elseif($count==2 || $count==4){
						$col = 'qqfs-md-6';
					}
					while ($the_query->have_posts()) : $the_query->the_post();
						$check_id = 'quote-qqfs-control-id-'.get_the_ID();
						$price = get_post_meta(get_the_ID(), 'quote_qqfs_price', true);
						if(!$price) $price = 0;
						
						$quote_qqfs_note = get_post_meta(get_the_ID(), 'quote_qqfs_note', true);
					?>
                    	<div class="qqfs-4 <?php echo esc_attr($col);?>">
                        	<div class="quote-qqfs-control-item">
                            	<div class="qqfs-center">
                                    <div class="form-check form-switch">
                                        <input data-amount="<?php echo esc_attr($price); ?>" 
                                        	   data-group="<?php echo esc_attr($checkbox_group);?>"
                                               data-id="<?php echo esc_attr(get_the_ID());?>" 
                                               name="quote-qqfs-control-item" 
                                               class="form-check-input <?php echo esc_attr($checkbox_type);?>" 
                                               type="checkbox" 
                                               id="<?php echo esc_attr($check_id); ?>">
                                    </div>
                                </div>
                                <div class="qqfs-center quote-qqfs-control-desc"><label for="<?php echo esc_attr($check_id); ?>"><?php the_title(); ?></label></div>
                                <?php 
								if($quote_qqfs_note){
								?>
                                <div class="qqfs-center quote-qqfs-control-bonus"><?php echo wp_kses_post($quote_qqfs_note); ?></div>
                                <?php 
								}
								?>
                        	</div>
                        </div>
					<?php
                    endwhile;
					$html = ob_get_contents();
					ob_end_clean();
					
					$i_step = $i_step +1;
					$btn_next_text = __('Next', WS247_QUOTE_QQFS_TEXTDOMAIN);
					
					$btn_reset = '<button type="button" class="btn btn-dark js-ws247-quote-qqfs-reset">'.__('Reset', WS247_QUOTE_QQFS_TEXTDOMAIN).'</button>';
				endif;
			}else{
				$i_step = -1;
				$html = Wp247_quote_qqfs_Helper::get_template_part('frontend/form', '', $echo);
				$btn_next_text = __('Finish', WS247_QUOTE_QQFS_TEXTDOMAIN);
			}
			
			
			//_RESPONSE
			$response = array	(
									'html' => $html,
									'i_step' => $i_step,
									'btn_next_text' => $btn_next_text,
									'btn_reset' => $btn_reset,
									'is_req' => $is_req
								);
			wp_send_json($response);
		}
		
		public function ws247_quote_qqfs_btn_save_form(){
			header("Content-Type: application/json", true);
			$quote_request_id = 0; $html = '';
			
			$arr_data_step = Wp247_quote_qqfs_Helper::get_step_save() ;

			//_REQUEST
			$form_data_json = sanitize_meta( 'form_data_json', wp_unslash($_REQUEST['form_data_json']), 'post' );
			$quoteid = absint( wp_unslash($_REQUEST['quoteid']) );
			
			//_DO ACTION
			$arr_form_data = json_decode($form_data_json, true);
			if(is_array($arr_form_data) && $arr_data_step && $quoteid){
				$arr_qqfs_options = Ws247_quote_qqfs::get_qqfs_options();
				
				$total = 0; $arr_detail_option = array();
				
				foreach($arr_data_step as $pt => $list_ids){
					$detail_option = array();
					$detail_option['step_title'] = $arr_qqfs_options[$pt]; 
					
					$arr_ids = explode(",", $list_ids);
					if($arr_ids){
						$arr_ = array();
						foreach($arr_ids as $pt_id){
							$amount = get_post_meta($pt_id, 'quote_qqfs_price', true);
							$pt_title = get_the_title($pt_id);
							$arr_[$pt_id] = array('title' => $pt_title, 'amount' => $amount);
							$total = $total + $amount;
						}
						$detail_option['step_options'] = $arr_; 
					}
					$arr_detail_option[$pt] = $detail_option;
				}
				
				//Save Quote Request
				$post_data = array(
						  'post_type' => 'req_quote_qqfs_pt',
						  'post_title'    => '#'.time(),
						  'post_status'   => 'publish',
						  'meta_input'   => array(
						  		'quoteid' 	=> $quoteid,
								'arr_detail_option'	=> $arr_detail_option,
								'arr_form_data' 	=> $arr_form_data,
								'total'	=> $total,
								'archive_data_step' 	=> $arr_data_step
							)
						);
				$quote_request_id = wp_insert_post( $post_data, true );
				
				//Send email
				self::send_email_quote_request($quote_request_id);
				
				$html = apply_filters('the_content', get_post_meta($quoteid, 'quote_qqfs_after_form', true));
				if(!$html){
					$html = __('Thank you for contacting us!', WS247_QUOTE_QQFS_TEXTDOMAIN);
				}
				
				$html .= '<a href="'.get_site_url().'" class="btn btn-success">'.__('Go Back Homepage', WS247_QUOTE_QQFS_TEXTDOMAIN).'</button>';
				
				self::step_empty();
			}else{
				wp_send_json(array('error'=>1, 'mes'=>__('An error occurred E101', WS247_QUOTE_QQFS_TEXTDOMAIN)));
			}
			
			//_RESPONSE
			$response = array	(	'error'=>0,
									'html' => $html,
									'quote_request_id' => $quote_request_id
								);
			wp_send_json($response);
		}
		
		public static function send_email_quote_request($quote_request_id){
			if( get_post_status( $quote_request_id ) != 'publish' ){
				return false;
			}
			$quoteid = get_post_meta($quote_request_id , 'quoteid', true); 
			$receive_email = get_post_meta($quoteid, 'quote_qqfs_receive_email', true);
			if(!$receive_email){
				$receive_email = Ws247_quote_qqfs::class_get_option('receive_email');
			}
			
			if(!$receive_email) return false;
			
			do_action( 'qqfs_before_send_email' );
			
			$quote_code = get_the_title($quote_request_id);
			$arr_form_data = get_post_meta($quote_request_id , 'arr_form_data', true);
			$customer_email = $arr_form_data['email'];
			
			set_query_var( 'quote_request_id', $quote_request_id );
			$email_content = Wp247_quote_qqfs_Helper::get_template_part('frontend/email', '', false);
			$email_content = apply_filters('ws247_qqfs_email_content_html', $email_content, $quote_request_id);
			
			$headers = "Content-Type: text/html; charset=utf-8\r\n";
			$headers .= "From: " . $receive_email . " <" . $receive_email . ">\r\n";
			$subject = __('There is a new quote request:', WS247_QUOTE_QQFS_TEXTDOMAIN).' '.$quote_code;	
							
			$is_sent = wp_mail(trim($receive_email), $subject, $email_content, $headers, "");
			
			if($customer_email){
				$subject = __('You have just requested a quote:', WS247_QUOTE_QQFS_TEXTDOMAIN) . ' '. $quote_code.' '.__('from', WS247_QUOTE_QQFS_TEXTDOMAIN).' '.$_SERVER['HTTP_HOST'];
				$is_sent_customer = wp_mail(trim($customer_email), $subject, $email_content, $headers, "");
			}
			
			do_action( 'qqfs_after_send_email' );
			
			return $is_sent;	
			
		}
		
		public static function get_currency_symbols(){
			$symbols = array(
							'AED' => '&#x62f;.&#x625;',
							'AFN' => '&#x60b;',
							'ALL' => 'L',
							'AMD' => 'AMD',
							'ANG' => '&fnof;',
							'AOA' => 'Kz',
							'ARS' => '&#36;',
							'AUD' => '&#36;',
							'AWG' => 'Afl.',
							'AZN' => 'AZN',
							'BAM' => 'KM',
							'BBD' => '&#36;',
							'BDT' => '&#2547;&nbsp;',
							'BGN' => '&#1083;&#1074;.',
							'BHD' => '.&#x62f;.&#x628;',
							'BIF' => 'Fr',
							'BMD' => '&#36;',
							'BND' => '&#36;',
							'BOB' => 'Bs.',
							'BRL' => '&#82;&#36;',
							'BSD' => '&#36;',
							'BTC' => '&#3647;',
							'BTN' => 'Nu.',
							'BWP' => 'P',
							'BYR' => 'Br',
							'BYN' => 'Br',
							'BZD' => '&#36;',
							'CAD' => '&#36;',
							'CDF' => 'Fr',
							'CHF' => '&#67;&#72;&#70;',
							'CLP' => '&#36;',
							'CNY' => '&yen;',
							'COP' => '&#36;',
							'CRC' => '&#x20a1;',
							'CUC' => '&#36;',
							'CUP' => '&#36;',
							'CVE' => '&#36;',
							'CZK' => '&#75;&#269;',
							'DJF' => 'Fr',
							'DKK' => 'DKK',
							'DOP' => 'RD&#36;',
							'DZD' => '&#x62f;.&#x62c;',
							'EGP' => 'EGP',
							'ERN' => 'Nfk',
							'ETB' => 'Br',
							'EUR' => '&euro;',
							'FJD' => '&#36;',
							'FKP' => '&pound;',
							'GBP' => '&pound;',
							'GEL' => '&#x20be;',
							'GGP' => '&pound;',
							'GHS' => '&#x20b5;',
							'GIP' => '&pound;',
							'GMD' => 'D',
							'GNF' => 'Fr',
							'GTQ' => 'Q',
							'GYD' => '&#36;',
							'HKD' => '&#36;',
							'HNL' => 'L',
							'HRK' => 'kn',
							'HTG' => 'G',
							'HUF' => '&#70;&#116;',
							'IDR' => 'Rp',
							'ILS' => '&#8362;',
							'IMP' => '&pound;',
							'INR' => '&#8377;',
							'IQD' => '&#x639;.&#x62f;',
							'IRR' => '&#xfdfc;',
							'IRT' => '&#x062A;&#x0648;&#x0645;&#x0627;&#x0646;',
							'ISK' => 'kr.',
							'JEP' => '&pound;',
							'JMD' => '&#36;',
							'JOD' => '&#x62f;.&#x627;',
							'JPY' => '&yen;',
							'KES' => 'KSh',
							'KGS' => '&#x441;&#x43e;&#x43c;',
							'KHR' => '&#x17db;',
							'KMF' => 'Fr',
							'KPW' => '&#x20a9;',
							'KRW' => '&#8361;',
							'KWD' => '&#x62f;.&#x643;',
							'KYD' => '&#36;',
							'KZT' => '&#8376;',
							'LAK' => '&#8365;',
							'LBP' => '&#x644;.&#x644;',
							'LKR' => '&#xdbb;&#xdd4;',
							'LRD' => '&#36;',
							'LSL' => 'L',
							'LYD' => '&#x644;.&#x62f;',
							'MAD' => '&#x62f;.&#x645;.',
							'MDL' => 'MDL',
							'MGA' => 'Ar',
							'MKD' => '&#x434;&#x435;&#x43d;',
							'MMK' => 'Ks',
							'MNT' => '&#x20ae;',
							'MOP' => 'P',
							'MRU' => 'UM',
							'MUR' => '&#x20a8;',
							'MVR' => '.&#x783;',
							'MWK' => 'MK',
							'MXN' => '&#36;',
							'MYR' => '&#82;&#77;',
							'MZN' => 'MT',
							'NAD' => 'N&#36;',
							'NGN' => '&#8358;',
							'NIO' => 'C&#36;',
							'NOK' => '&#107;&#114;',
							'NPR' => '&#8360;',
							'NZD' => '&#36;',
							'OMR' => '&#x631;.&#x639;.',
							'PAB' => 'B/.',
							'PEN' => 'S/',
							'PGK' => 'K',
							'PHP' => '&#8369;',
							'PKR' => '&#8360;',
							'PLN' => '&#122;&#322;',
							'PRB' => '&#x440;.',
							'PYG' => '&#8370;',
							'QAR' => '&#x631;.&#x642;',
							'RMB' => '&yen;',
							'RON' => 'lei',
							'RSD' => '&#1088;&#1089;&#1076;',
							'RUB' => '&#8381;',
							'RWF' => 'Fr',
							'SAR' => '&#x631;.&#x633;',
							'SBD' => '&#36;',
							'SCR' => '&#x20a8;',
							'SDG' => '&#x62c;.&#x633;.',
							'SEK' => '&#107;&#114;',
							'SGD' => '&#36;',
							'SHP' => '&pound;',
							'SLL' => 'Le',
							'SOS' => 'Sh',
							'SRD' => '&#36;',
							'SSP' => '&pound;',
							'STN' => 'Db',
							'SYP' => '&#x644;.&#x633;',
							'SZL' => 'L',
							'THB' => '&#3647;',
							'TJS' => '&#x405;&#x41c;',
							'TMT' => 'm',
							'TND' => '&#x62f;.&#x62a;',
							'TOP' => 'T&#36;',
							'TRY' => '&#8378;',
							'TTD' => '&#36;',
							'TWD' => '&#78;&#84;&#36;',
							'TZS' => 'Sh',
							'UAH' => '&#8372;',
							'UGX' => 'UGX',
							'USD' => '&#36;',
							'UYU' => '&#36;',
							'UZS' => 'UZS',
							'VEF' => 'Bs F',
							'VES' => 'Bs.S',
							'VND' => '&#8363;',
							'VUV' => 'Vt',
							'WST' => 'T',
							'XAF' => 'CFA',
							'XCD' => '&#36;',
		
							'XOF' => 'CFA',
							'XPF' => 'Fr',
							'YER' => '&#xfdfc;',
							'ZAR' => '&#82;',
							'ZMW' => 'ZK',
						);
		
			return $symbols;
		}
	
	
	// end class-------------------------------------------------------------------------
	}
endif;