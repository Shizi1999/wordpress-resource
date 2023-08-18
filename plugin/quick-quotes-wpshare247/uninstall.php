<?php

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

function pl_wp247_quote_qqfs_delete_plugin() {
	global $wpdb; $prefix = 'WS247_QUOTE_QQFS';
	
	//Delete post if exist
	$s_post_type = "'quote_qqfs_pt', 'req_quote_qqfs_pt'";
	$s_post_type_options = $wpdb->get_var( "SELECT `option_value` FROM $wpdb->options WHERE `option_name` = 'WS247_QUOTE_QQFS_qqfs_options'" );
	$arr_post_type_options = maybe_unserialize($s_post_type_options);
	if(!empty($arr_post_type_options)){
		$s_post_type .= ",'".implode("','", array_keys($arr_post_type_options))."'";
	}
	$wpdb->query( "DELETE FROM {$wpdb->posts} WHERE post_type IN ( ".$s_post_type." );" );
	$wpdb->query( "DELETE meta FROM {$wpdb->postmeta} meta LEFT JOIN {$wpdb->posts} posts ON posts.ID = meta.post_id WHERE posts.ID IS NULL;" );
	
	//Delete option if exist
	$plugin_options = $wpdb->get_results( "	SELECT `option_name` 
											FROM $wpdb->options 
											WHERE ( `option_name` LIKE '".$prefix."%' 
													|| `option_name` LIKE 'qqfs_%' 
													|| `option_name` LIKE 'req_qqfs_%'	
												)
										" );
	if($plugin_options):
		foreach( $plugin_options as $option ) {
			delete_option( $option->option_name );
		}
	endif;
	
	wp_cache_flush();
}

pl_wp247_quote_qqfs_delete_plugin();