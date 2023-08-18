<table id="tab_pro_general" class="form-table aeiwooc-tab active">
    <!--List field here .....-->
    
    <!-- ........................ -->
    <tr valign="top">
        <td>
        	<h3 class="title"><?php esc_html_e("Create new option", WS247_QUOTE_QQFS_TEXTDOMAIN); ?></h3>
            <div class="quote_qqfs-block">
				<?php 
                $field_name = 'option_new';
                $field = Ws247_quote_qqfs::create_option_prefix($field_name);
                $val = Ws247_quote_qqfs::class_get_option($field_name);
                ?>
                <input placeholder="<?php esc_html_e("Option name", WS247_QUOTE_QQFS_TEXTDOMAIN); ?>" type="text" id="<?php echo esc_html($field); ?>" name="<?php echo esc_html($field); ?>" value="" />
                <button id="js_ws247_quote_qqfs_add_option" data-input="#<?php echo esc_html($field); ?>" type="button" class="button"><?php esc_html_e("Add new", WS247_QUOTE_QQFS_TEXTDOMAIN); ?></button>
                <span id="quote_qqfs-spinner" class="spinner"></span>
            </div>
        </td>
    </tr>
    
    <?php 
	$arr_qqfs_options = Ws247_quote_qqfs::get_qqfs_options();
	?>
    <tr valign="top">
        <td>
        	<h3 class="title"><?php esc_html_e("List of options", WS247_QUOTE_QQFS_TEXTDOMAIN); ?> <span id="arr_qqfs_options-spinner" class="spinner"></span></h3>
           	
            <table id="arr_qqfs_options" class="qqfs-option sortcontainer form-table">
            	<colgroup>
                    <col width="10%">
                    <col width="60%">
                    <col width="10%">
                   	<col width="10%">
                    <col width="10%">
                </colgroup>
            	<thead>
                	<th><?php esc_html_e("No", WS247_QUOTE_QQFS_TEXTDOMAIN); ?></th>
                    <th><?php esc_html_e("Name", WS247_QUOTE_QQFS_TEXTDOMAIN); ?></th>
                    <th><?php esc_html_e("Required", WS247_QUOTE_QQFS_TEXTDOMAIN); ?></th>
                    <th><?php esc_html_e("Choose only one", WS247_QUOTE_QQFS_TEXTDOMAIN); ?></th>
                    <th><?php esc_html_e("Actions", WS247_QUOTE_QQFS_TEXTDOMAIN); ?></th>
                </thead>
                <tbody>
                	<?php 
					if($arr_qqfs_options){
						$jj = 1;
						foreach($arr_qqfs_options as $opt_key => $option_it){
							$is_req = get_option('req_'.$opt_key);
							$req_chck = '';
							if($is_req){
								$req_chck = 'checked';
							}
							
							$is_choose_one = get_option($opt_key);
							$chck = '';
							if($is_choose_one){
								$chck = 'checked';
							}
						?>
							<tr id="<?php echo esc_attr($opt_key); ?>" class="sortable">
								<td><span class="no"><?php echo esc_attr($jj); ?></span></td>
								<td><span class="name"><?php echo esc_attr($option_it); ?></span></td>
                                <td>
                                    <span class="checkbox-req">
                                        <input <?php echo esc_attr($req_chck); ?> data-type="<?php echo esc_attr($opt_key); ?>" type="checkbox" />
                                    </span>
                                </td>
								<td>
                                    <span class="checkbox-type">
                                        <input <?php echo esc_attr($chck); ?> data-type="<?php echo esc_attr($opt_key); ?>" type="checkbox" />
                                    </span>
                                </td>
								<td>
                                	<span class="view"><a href="<?php echo admin_url('edit.php?post_type='.$opt_key); ?>"><?php esc_html_e("View", WS247_QUOTE_QQFS_TEXTDOMAIN); ?></a></span>
									<span class="del"><a class="js_ws247_quote_qqfs_del_option" data-id="<?php echo esc_attr($opt_key); ?>" href="#"><?php esc_html_e("Delete", WS247_QUOTE_QQFS_TEXTDOMAIN); ?></a></span>
                                </td>
							</tr>
						<?php
							$jj++;
						}
					}else{
					?>
					<tr><td colspan="5"><?php esc_html_e("No options yet. Add new options to start creating quotes.", WS247_QUOTE_QQFS_TEXTDOMAIN); ?></td></tr>
					<?php
					}
					?>
                </tbody>
            </table>
        </td>
    </tr>
    
    <tr valign="top">
        <td>
        	<h3 class="title"><?php esc_html_e("Currency", WS247_QUOTE_QQFS_TEXTDOMAIN); ?></h3>
            <label><?php esc_html_e("Currency type", WS247_QUOTE_QQFS_TEXTDOMAIN); ?></label>
            <?php 
            $field_name = 'currency'; 
            $field = Ws247_quote_qqfs::create_option_prefix($field_name);
            $val_currency = Ws247_quote_qqfs::class_get_option($field_name);
			$arr_currency_symbols = Wp247_quote_qqfs_Helper::get_currency_symbols();
            ?>
            <select id="<?php echo esc_html($field); ?>" name="<?php echo esc_html($field); ?>">
            	<option value=""><?php esc_html_e("Select", WS247_QUOTE_QQFS_TEXTDOMAIN); ?></option>
            	<?php 
				foreach($arr_currency_symbols as $currency => $symbol){
					$selected = '';
					if($val_currency && $currency==$val_currency){
						$selected = 'selected';
					}
					if($currency=='VND' && $val_currency==''){
						$selected = 'selected';
					}
				?>
                <option <?php echo $selected; ?> value="<?php echo esc_attr($currency); ?>"><?php echo esc_attr($symbol); ?></option>
                <?php
				}
				?>
            </select>
        </td>
    </tr>
    
    <tr valign="top">
        <td>
            <?php 
			$field_name = 'currency_pos';
			$field = Ws247_quote_qqfs::create_option_prefix($field_name);
			$val = Ws247_quote_qqfs::class_get_option($field_name);
			?>
            <label><?php esc_html_e("Symbol position", WS247_QUOTE_QQFS_TEXTDOMAIN); ?></label>
			<select id="<?php echo esc_html($field); ?>" name="<?php echo esc_html($field); ?>">
            	<option <?php if($val=='') echo 'selected'; ?> value=""><?php esc_html_e("Right", WS247_QUOTE_QQFS_TEXTDOMAIN); ?></option>
                <option <?php if($val=='left') echo 'selected'; ?> value="left"><?php esc_html_e("Left", WS247_QUOTE_QQFS_TEXTDOMAIN); ?></option>
            </select>
        </td>
    </tr>
    
    <tr valign="top">
        <td>
            <?php 
			$field_name = 'price_thousand_sep';
			$field = Ws247_quote_qqfs::create_option_prefix($field_name);
			$val = Ws247_quote_qqfs::class_get_option($field_name);
			?>
            <label><?php esc_html_e("Thousand separator", WS247_QUOTE_QQFS_TEXTDOMAIN); ?></label>
			<input placeholder="<?php esc_html_e(",", WS247_QUOTE_QQFS_TEXTDOMAIN); ?>" type="text" id="<?php echo esc_html($field); ?>" name="<?php echo esc_html($field); ?>" value="<?php echo esc_attr($val); ?>" />
        </td>
    </tr>
    
     <tr valign="top">
        <td>
            <?php 
			$field_name = 'price_decimal_sep';
			$field = Ws247_quote_qqfs::create_option_prefix($field_name);
			$val = Ws247_quote_qqfs::class_get_option($field_name);
			?>
            <label><?php esc_html_e("Decimal separator", WS247_QUOTE_QQFS_TEXTDOMAIN); ?></label>
			<input placeholder="<?php esc_html_e(".", WS247_QUOTE_QQFS_TEXTDOMAIN); ?>" type="text" id="<?php echo esc_html($field); ?>" name="<?php echo esc_html($field); ?>" value="<?php echo esc_attr($val); ?>" />
        </td>
    </tr>
    
    <tr valign="top">
        <td>
            <?php 
			$field_name = 'price_num_decimals';
			$field = Ws247_quote_qqfs::create_option_prefix($field_name);
			$val = Ws247_quote_qqfs::class_get_option($field_name);
			?>
            <label><?php esc_html_e("Number of decimals", WS247_QUOTE_QQFS_TEXTDOMAIN); ?></label>
			<input placeholder="<?php esc_html_e("0", WS247_QUOTE_QQFS_TEXTDOMAIN); ?>" type="number" id="<?php echo esc_html($field); ?>" name="<?php echo esc_html($field); ?>" value="<?php echo esc_attr($val); ?>" />
        </td>
    </tr>
    
    <tr valign="top">
        <td>
        	<h3 class="title"><?php esc_html_e("Email", WS247_QUOTE_QQFS_TEXTDOMAIN); ?></h3>
			<?php 
			$field_name = 'receive_email';
			$field = Ws247_quote_qqfs::create_option_prefix($field_name);
			$val = Ws247_quote_qqfs::class_get_option($field_name);
			?>
            <label><?php esc_html_e("Email for a quote", WS247_QUOTE_QQFS_TEXTDOMAIN); ?></label>
			<input placeholder="<?php esc_html_e("hotro@tbay.vn", WS247_QUOTE_QQFS_TEXTDOMAIN); ?>" type="text" id="<?php echo esc_html($field); ?>" name="<?php echo esc_html($field); ?>" value="<?php echo esc_attr($val); ?>" />
        </td>
    </tr>
    
    <!-- ........................ -->
    <tr valign="top">
        <th scope="row" style="padding-top:0; padding-bottom:0;" colspan="2">
            <a href="<?php echo admin_url('edit.php?post_type=quote_qqfs_pt'); ?>" class="quotes"><?php esc_html_e("Create new quote", WS247_QUOTE_QQFS_TEXTDOMAIN); ?></a>
        </th>
    </tr>
    
</table>