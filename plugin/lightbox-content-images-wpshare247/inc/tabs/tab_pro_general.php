<table id="tab_pro_general" class="form-table aeiwooc-tab active">
    <!--List field here .....-->                               
    
    <tr valign="top">
        <th scope="row">
            <?php esc_html_e("Enable for post type", WS247_LCIMAGES_TEXTDOMAIN); ?>
        </th>
        <td id="Ws247_lcimages_post_type_td">
            <ul>
                <!-- Load ajax 'ws247_lcimages_init_load_post_types' -->
            </ul>
        </td>
    </tr>
    
    <tr valign="top">
        <th scope="row">
            <?php esc_html_e("Zoom Icon", WS247_LCIMAGES_TEXTDOMAIN); ?>
        </th>
        <td>
             <?php 
            $field_name = 'zoom_icon_pos'; 
            $field = Ws247_lcimages_Setting::create_option_prefix($field_name);
            $zoom_icon_pos = Ws247_lcimages_Setting::class_get_option($field_name);
            ?>
            <select id="<?php echo esc_html($field); ?>" name="<?php echo esc_html($field); ?>">
                <option <?php if($zoom_icon_pos=='') echo 'selected'; ?> value="0"><?php esc_html_e("Top right", WS247_LCIMAGES_TEXTDOMAIN); ?></option>
                <option <?php if($zoom_icon_pos=='1') echo 'selected'; ?> value="1"><?php esc_html_e("Bottom right", WS247_LCIMAGES_TEXTDOMAIN); ?></option>
            	<option <?php if($zoom_icon_pos=='2') echo 'selected'; ?> value="2"><?php esc_html_e("Bottom left", WS247_LCIMAGES_TEXTDOMAIN); ?></option>
            	<option <?php if($zoom_icon_pos=='3') echo 'selected'; ?> value="3"><?php esc_html_e("Top left", WS247_LCIMAGES_TEXTDOMAIN); ?></option>
            	<option <?php if($zoom_icon_pos=='4') echo 'selected'; ?> value="4"><?php esc_html_e("Center", WS247_LCIMAGES_TEXTDOMAIN); ?></option>
                <option <?php if($zoom_icon_pos=='5') echo 'selected'; ?> value="5"><?php esc_html_e("Hide", WS247_LCIMAGES_TEXTDOMAIN); ?></option>
            </select>
        </td>
    </tr>
  	
    <tr valign="top">
        <th scope="row">
            <?php esc_html_e("Disable", WS247_LCIMAGES_TEXTDOMAIN); ?>
        </th>
        <td>
             <?php 
            $field_name = 'disable'; 
            $field = Ws247_lcimages_Setting::create_option_prefix($field_name);
            $hide = Ws247_lcimages_Setting::class_get_option($field_name);
            ?>
            <input <?php if($hide=='on') echo 'checked'; ?> type="checkbox" id="<?php echo esc_html($field); ?>" name="<?php echo esc_html($field); ?>" /><label for="<?php echo esc_html($field); ?>"><?php esc_html_e("Temporarily off", WS247_LCIMAGES_TEXTDOMAIN); ?></label>
        </td>
    </tr>
    
</table>