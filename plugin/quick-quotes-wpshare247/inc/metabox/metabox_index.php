<?php
if( !class_exists('Wp247_quote_qqfs_metabox') ):
	
	class Wp247_quote_qqfs_metabox{
		/**
		 * Constructor
		 */
		function __construct() { 
			add_action( 'add_meta_boxes', array($this, 'add_metabox_post_type') );
			$this->save_post();
		}
		
		public function add_metabox_post_type(){
			$this->add_metabox_quotes();
			$this->add_metabox_quote_requests();
			$this->add_metabox_options();
		}
		
		public function add_metabox_quotes(){
			$id = 'quote_qqfs_after_form_box';
			$title = __( 'Content after sending information', WS247_QUOTE_QQFS_TEXTDOMAIN );
			$arr_post_type = 'quote_qqfs_pt'; // array
			$context = 'normal'; // advanced ; side ; normal
			$priority = 'default'; // low ; high; default
			$callback_args =  array( );
			add_meta_box( $id, $title, array($this, 'create_metabox_html_quote_after_form'), $arr_post_type, $context, $priority, $callback_args);
			
			//Manage list options for Quote Step
			$id = 'quote_qqfs_steps';
			$title = __( 'Manage Options', WS247_QUOTE_QQFS_TEXTDOMAIN );
			$arr_post_type = 'quote_qqfs_pt';
			$context = 'normal';
			$priority = 'default'; 
			$callback_args =  array( );
			add_meta_box( $id, $title, array($this, 'create_metabox_html_quote'), $arr_post_type, $context, $priority, $callback_args);
			
			//Manage list options for Quote Step
			$id = 'quote_qqfs_email';
			$title = __( 'Email for a quote', WS247_QUOTE_QQFS_TEXTDOMAIN );
			$arr_post_type = 'quote_qqfs_pt';
			$context = 'side';
			$priority = 'default'; 
			$callback_args =  array( );
			add_meta_box( $id, $title, array($this, 'create_metabox_html_quote_email'), $arr_post_type, $context, $priority, $callback_args);
		}
		
		public function add_metabox_quote_requests(){
			$id = 'quote_qqfs_quote_requests';
			$title = __( 'Quote request details', WS247_QUOTE_QQFS_TEXTDOMAIN );
			$arr_post_type = 'req_quote_qqfs_pt';
			$context = 'normal'; 
			$priority = 'default';
			$callback_args =  array( );
			add_meta_box( $id, $title, array($this, 'create_metabox_html_quote_requests'), $arr_post_type, $context, $priority, $callback_args);
			
			
			$id = 'quote_qqfs_quote_requests_status';
			$title = __( 'Status', WS247_QUOTE_QQFS_TEXTDOMAIN );
			$arr_post_type = 'req_quote_qqfs_pt';
			$context = 'side';
			$priority = 'default';
			$callback_args =  array( );
			add_meta_box( $id, $title, array($this, 'create_metabox_html_quote_requests_status'), $arr_post_type, $context, $priority, $callback_args);
		}
		
		
		public function create_metabox_html_quote_requests($post, $callback_args){
			$post_ID = $post->ID;
			$quoteid = get_post_meta($post_ID , 'quoteid', true); 
			$arr_detail_option = get_post_meta($post_ID , 'arr_detail_option', true);
			$arr_form_data = get_post_meta($post_ID , 'arr_form_data', true);
			$total = get_post_meta($post_ID , 'total', true);
			?>
            <section class="quote-requests-detail quote-detail-mtbox">
            	<div class="group">
                	<div class="row">
                    	<label class="header quote-request"><?php echo get_the_title($post_ID); ?></label><br/>
                    	<label class="header"><?php echo get_the_title($quoteid); ?></label>
                    </div>
                </div>
                
                <div class="group">
                	<div class="row">
                    	<label class="header"><?php esc_html_e('Quotation steps', WS247_QUOTE_QQFS_TEXTDOMAIN); ?></label>
                    </div>
                    <?php 
					$kk = 1;
					foreach($arr_detail_option as $pt => $arr_option){
						$step_title = $arr_option['step_title'];
						$arr_step_options = $arr_option['step_options'];
						?>
                        <div class="row">
                        	<label class="header2"><?php echo esc_attr($kk. ')'. $step_title); ?></label>
                            <?php 
							if($arr_option){
								?>
                                <ul class="steps">
                                <?php
								foreach($arr_step_options as $id => $arr_option){
									$title = $arr_option['title'];
									$amount = Ws247_quote_qqfs_function::quote_format_money($arr_option['amount'], true); 
									?>
                                    <li><label><?php echo esc_attr($title); ?>:</label> <span><?php echo $amount; ?></span></li>
                                    <?php
								}
								?>
                                </ul>
                                <?php
							}
							?>
                        </div>
                        <?php
						$kk++;
					}
					?>
                </div>
                
                <div class="group">
                	<div class="row">
                    	<label class="header"><?php esc_html_e('Customer information', WS247_QUOTE_QQFS_TEXTDOMAIN); ?></label>
                    </div>
                    <ul>
                    <?php 
					foreach($arr_form_data as $key => $form_field_val){
						?>
                        <li><label><?php echo esc_attr($form_field_val); ?></label></li>
                        <?php
					}
					?>
                    </ul>
                </div>
                
                <div class="group">
                	<div class="row">
                    	<label class="header"><?php esc_html_e('Quotation total', WS247_QUOTE_QQFS_TEXTDOMAIN); ?></label>
                    </div>
                    <ul>
						<li><label><?php echo Ws247_quote_qqfs_function::quote_format_money($total, true); ?></label></li>                    
                    </ul>
                </div>
            </section>
            <?php
		}
		
		
		public function create_metabox_html_quote_requests_status($post, $callback_args){
			$post_id = $post->ID;
			$key = 'quote_qqfs_requests_status';
			$val = get_post_meta($post_id, $key, true);
			?>
            <p>
                <label><?php esc_html_e('Quote Status', WS247_QUOTE_QQFS_TEXTDOMAIN); ?></label><br/>
         		<select id="<?php echo esc_html($key); ?>" name="<?php echo esc_html($key); ?>">
                	<option value=""><?php esc_html_e('New', WS247_QUOTE_QQFS_TEXTDOMAIN); ?></option>
                    <option <?php if($val==1) echo 'selected'; ?> value="1"><?php esc_html_e('Checked', WS247_QUOTE_QQFS_TEXTDOMAIN); ?></option>
                    <option <?php if($val==2) echo 'selected'; ?> value="2"><?php esc_html_e('Contacted', WS247_QUOTE_QQFS_TEXTDOMAIN); ?></option>
                    <option <?php if($val==3) echo 'selected'; ?> value="3"><?php esc_html_e('Complete', WS247_QUOTE_QQFS_TEXTDOMAIN); ?></option>
                </select>
            </p>
            <?php
		}
		
		public function create_metabox_html_quote_email($post, $callback_args){
			$post_id = $post->ID;
			$key = 'quote_qqfs_receive_email';
			$val = get_post_meta($post_id, $key, true);
			?>
            <p>
         		<input type="text" name="<?php echo esc_html($key); ?>" id="<?php echo esc_html($key); ?>" value="<?php echo esc_attr($val); ?>" style="width:100%" placeholder="<?php echo esc_attr('hotro@tbay.vn'); ?>" class="w366-mtb-text">
            </p>
            <?php
		}
		
		public function create_metabox_html_quote_after_form($post, $callback_args){
			$post_id = $post->ID;
			$key = 'quote_qqfs_after_form';
			$val = get_post_meta($post_id, $key, true);
			?>
            <p>
         		<textarea id="<?php echo esc_html($key); ?>" name="<?php echo esc_html($key); ?>"><?php echo esc_attr($val); ?></textarea>
            </p>
            <?php
		}
		
		public function create_metabox_html_quote($post, $callback_args){
			$key = 'quote_qqfs_pt_step';
			$post_id = absint(wp_unslash($_REQUEST['post']));
			$val = get_post_meta($post_id, $key, true);
			$arr_val = array();
			if($val){
				$arr_val = (array)explode(',', $val);
			}
			
			$arr_qqfs_options = Ws247_quote_qqfs::get_qqfs_options(); 
			if($arr_qqfs_options){
				$arr_qqfs_options_keys = array_keys($arr_qqfs_options); 
		?>
        	<p class="header">
                <label><?php esc_html_e('Create a list of quotation steps', WS247_QUOTE_QQFS_TEXTDOMAIN); ?> (*1)</label>
            </p>
        	<ul id="qqfs-option-bx" class="qqfs-option-bx sortcontainer connectedSortable">
				<?php 
                foreach($arr_qqfs_options as $opt_key => $option_it){
					if(!in_array($opt_key, $arr_val) ){
                ?>
                    <li id="<?php echo esc_attr($opt_key); ?>" class="sortable">
                        <span class="name"><?php echo esc_attr($option_it); ?></span>
                    </li>
                <?php
					}
                }
                ?>
            </ul>
            
            <p class="header">
                <label><?php esc_html_e('Drag the options here to create a quote', WS247_QUOTE_QQFS_TEXTDOMAIN); ?> (*2)</label>
                <span class="spinner"></span>
            </p>
            <ul id="qqfs-option-bx-rel" class="qqfs-option-bx sortcontainer connectedSortable" data-postid="<?php echo esc_attr($post_id); ?>" data-postmeta="<?php echo esc_html($key); ?>">
				<?php 
				if($arr_val){
					$new_val = '';
					foreach($arr_val as $val_key){
						if(in_array($val_key, $arr_qqfs_options_keys)){
					?>
                        <li id="<?php echo esc_attr($val_key); ?>" class="sortable">
                            <span class="name"><?php echo esc_attr($arr_qqfs_options[$val_key]); ?></span>
                        </li>
                    <?php
							if(!$new_val){
								$new_val  = $val_key;
							}else{
								$new_val = $new_val . ',' .$val_key;
							}
						}
					}
					if($new_val != $val){
						update_post_meta( $post_id, 'quote_qqfs_pt_step', $new_val );
						$val = $new_val;
					}
				}
				?>
            </ul> 
            <small><?php esc_html_e("Drag and drop options to (*1) to delete", WS247_QUOTE_QQFS_TEXTDOMAIN);?></small>
            <input type="hidden" id="<?php echo esc_html($key); ?>" name="<?php echo esc_html($key); ?>" value="<?php echo esc_attr($val); ?>">
            <?php
				if($post_id){
				?>
                <section class="quote-qqfs-pt-step-group">
                    <p class="header">
                        <label><?php esc_html_e('Shortcode', WS247_QUOTE_QQFS_TEXTDOMAIN); ?></label>
                    </p>
                    <div id="quote_qqfs_shortcode" class="quote_qqfs_shortcode"><span onclick="ws247_quote_qqfs_copy_clipboard(this);" id="my-qqfs-shortcode">[quote_qqfs_new id="<?php echo esc_attr($post_id); ?>"]</span></div>
               		<small><?php esc_html_e("Copy Shortcode and embed anywhere to use.", WS247_QUOTE_QQFS_TEXTDOMAIN);?></small>
                </section>
                <?php
				}
			}else{
				esc_html_e("Create new option", WS247_QUOTE_QQFS_TEXTDOMAIN);
				?>
                <a target="_blank" href="<?php echo admin_url('admin.php?page=ws247-quick-quote-options'); ?>"><?php esc_html_e("Add new", WS247_QUOTE_QQFS_TEXTDOMAIN);?></a>
                <?php
			}
		}
		
		public function add_metabox_options(){
			$arr_qqfs_options = Ws247_quote_qqfs::get_qqfs_options();
			if($arr_qqfs_options){
				$arr_qqfs_posttype = array_keys($arr_qqfs_options);  //var_dump($arr_qqfs_posttype); exit;
				if($arr_qqfs_posttype){
					$id = uniqid( "qqfs_price_" );
					$title = __( 'Giá', '' );
					$arr_post_type = $arr_qqfs_posttype; // array
					$context = 'normal'; // advanced ; side ; normal
					$priority = 'default'; // low ; high; default
					$callback_args =  array( );
					add_meta_box( $id, $title, array($this, 'create_metabox_html'), $arr_post_type, $context, $priority, $callback_args);
				}
			}
		}
		
		public function create_metabox_html($post, $callback_args){
			$key = 'quote_qqfs_price';
			$title = __( 'Giá', '' );
			$post_id = $post->ID;
			$val = get_post_meta($post_id, $key, true);
			$placeholder = '250000';
		?>
        	<p>
                <label for="<?php echo esc_html($key); ?>"><?php echo esc_html($title); ?></label>
                <input type="text" name="<?php echo esc_html($key); ?>" id="<?php echo esc_html($key); ?>" value="<?php echo esc_attr($val); ?>" style="width:100%" placeholder="<?php echo esc_attr($placeholder); ?>" class="w366-mtb-text">
            </p>
        <?php
			$key = 'quote_qqfs_note';
			$title = __( 'Note', WS247_QUOTE_QQFS_TEXTDOMAIN );
			$post_id = $post->ID;
			$val = get_post_meta($post_id, $key, true);
			$placeholder = __( 'Bonus', WS247_QUOTE_QQFS_TEXTDOMAIN );
			?>
            <p>
                <label for="<?php echo esc_html($key); ?>"><?php echo esc_html($title); ?></label>
                <input type="text" name="<?php echo esc_html($key); ?>" id="<?php echo esc_html($key); ?>" value="<?php echo esc_attr($val); ?>" style="width:100%" placeholder="<?php echo esc_attr($placeholder); ?>" class="w366-mtb-text">
            </p>
            <?php
		}
		
		/*Save data*/
		public function sanitize_meta($meta_key){
			$meta_value = sanitize_meta( $meta_key, wp_unslash($_POST[$meta_key]), 'post' );
			return $meta_value;
		}
		
		public function save_post(){
			$arr_qqfs_options = Ws247_quote_qqfs::get_qqfs_options();
			if($arr_qqfs_options){
				$arr_qqfs_posttype = array_keys($arr_qqfs_options);
				if($arr_qqfs_posttype){
					foreach($arr_qqfs_posttype as $posttype){
						add_action( 'save_post_'.$posttype, array($this, 'save') );
					}
				}
			}
			
			add_action( 'save_post_quote_qqfs_pt', array($this, 'save_quote_qqfs_pt') );
			add_action( 'save_post_req_quote_qqfs_pt', array($this, 'save_req_quote_qqfs_pt') );
		}
		
		public function save($post_id){
			if($_POST){
				update_post_meta( $post_id, 'quote_qqfs_price', $this->sanitize_meta('quote_qqfs_price') );
				update_post_meta( $post_id, 'quote_qqfs_note', $this->sanitize_meta('quote_qqfs_note') );
			}
		}
		
		public function save_quote_qqfs_pt($post_id){
			if($_POST){
				update_post_meta( $post_id, 'quote_qqfs_pt_step', $this->sanitize_meta('quote_qqfs_pt_step') ); 
				update_post_meta( $post_id, 'quote_qqfs_after_form', $this->sanitize_meta('quote_qqfs_after_form') ); 
				update_post_meta( $post_id, 'quote_qqfs_receive_email', $this->sanitize_meta('quote_qqfs_receive_email') );
			}
		}
		
		public function save_req_quote_qqfs_pt($post_id){
			if($_POST){
				update_post_meta( $post_id, 'quote_qqfs_requests_status', $this->sanitize_meta('quote_qqfs_requests_status') ); 
			}
		}
		
	///------------------------	
	}
	
	new Wp247_quote_qqfs_metabox();
endif;