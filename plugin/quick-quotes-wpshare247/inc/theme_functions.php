<?php
/**
 * @class   Ws247_quote_qqfs_function
 */
 
if( !class_exists('Ws247_quote_qqfs_function') ):
	class Ws247_quote_qqfs_function{
		/**
		 * Constructor
		 */
		function __construct() {
			add_action( 'wp_enqueue_scripts', array($this, 'register_scripts') );
			add_action( 'wp_head', array($this, 'wp_head') );
		}
		
		public function wp_head() {
		?>
        	<script>
				var ws247_quote_qqfs_ajax_url = '<?php echo admin_url('admin-ajax.php'); ?>';
				var ws247_quote_qqfs_currency = '<?php echo self::get_currency(); ?>';
				var ws247_quote_qqfs_symbol = '<?php echo self::get_current_symbol(); ?>';
				var ws247_price_thousand_sep = '<?php echo Ws247_quote_qqfs::class_get_option('price_thousand_sep'); ?>'; 
				var ws247_price_num_decimals = '<?php echo Ws247_quote_qqfs::class_get_option('price_num_decimals'); ?>';
				
				function ws247_quote_qqfs_format_money( value, ws247_price_thousand_sep, ws247_price_num_decimals ){
					var new_value = parseFloat(value).toFixed(ws247_price_num_decimals);
					var res = new_value.toString().replace(/(\d)(?=(\d{3})+\b)/g, "$1"+ws247_price_thousand_sep );
					return res;
				}
            </script>
        <?php
		}
		
		public function register_scripts() {
			//Css
			wp_enqueue_style( 'wpshare247.com_ws247_quote_qqfs.css', WS247_QUOTE_QQFS_PLUGIN_INC_ASSETS_URL . '/ws247_quote_qqfs.css', false, '1.0' );
			wp_enqueue_script( 'wpshare247.com_ws247_quote_qqfs.js', WS247_QUOTE_QQFS_PLUGIN_INC_ASSETS_URL . '/js/ws247_quote_qqfs.js', array('jquery'), '1.0' );
			
		}
		
		public static function get_currency(){
			return Ws247_quote_qqfs::class_get_option('currency');
		}
		
		public static function get_currency_symbol( $currency ){
			$arr_currency_symbols = Wp247_quote_qqfs_Helper::get_currency_symbols();
			if($arr_currency_symbols){
				if($arr_currency_symbols[$currency]) return $arr_currency_symbols[$currency];
			}
			return '';
		}	
		
		public static function get_current_symbol(){
			return self::get_currency_symbol( self::get_currency() );
		}	
		
		public static function format_money($amount, $currency=false, $currency_position='', $f1=0, $f2='.', $f3=','){
			if($amount==='') return '';
			$f1 = (int)$f1;
			$s_amount = '<span class="amount" data-amount="'.$amount.'">'.number_format($amount, $f1, $f2, $f3). '</span>';
			if($currency){
				if($currency_position=='left'){
					$s_amount = self::get_current_symbol() . $s_amount;
				}else{
					$s_amount = $s_amount . self::get_current_symbol();
				}
			}
			return $s_amount;
		}
		
		public static function quote_format_money($amount, $currency=false){
			$currency_position = Ws247_quote_qqfs::class_get_option('currency_pos');
			$f1 = Ws247_quote_qqfs::class_get_option('price_thousand_sep'); 
			$f2 = Ws247_quote_qqfs::class_get_option('price_decimal_sep');
			$f3 = Ws247_quote_qqfs::class_get_option('price_num_decimals');
			return self::format_money($amount, $currency, $currency_position, $f3, $f2, $f1);
		}
		
		
	//End class------------------------
	}
	
	//Init
	$Ws247_quote_qqfs_function = new Ws247_quote_qqfs_function();
	
endif;