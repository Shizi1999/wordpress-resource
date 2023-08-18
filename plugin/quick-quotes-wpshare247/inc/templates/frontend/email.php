<?php 
$domain = $_SERVER['HTTP_HOST'];
$quoteid = get_post_meta($quote_request_id , 'quoteid', true); 
$arr_detail_option = get_post_meta($quote_request_id , 'arr_detail_option', true);
$arr_form_data = get_post_meta($quote_request_id , 'arr_form_data', true);
$total = get_post_meta($quote_request_id , 'total', true);
?>
<div id="email" style="width: 600px; margin: 0 auto; border-radius: 10px;">
	<section class="quote-requests-detail quote-detail-mtbox">
        <div class="group" style="margin-bottom: 20px;border: 1px solid #f0f0f1;padding: 10px 20px;">
            <div class="row">
                <label class="header quote-request" style="font-size: 2rem; font-weight: bold;"><?php echo get_the_title($quote_request_id); ?></label><br/>
                <label class="header" style="font-weight: bold;"><?php echo get_the_title($quoteid); ?></label>
            </div>
        </div>
        
        <div class="group" style="margin-bottom: 20px;border: 1px solid #f0f0f1;padding: 10px 20px;">
            <div class="row">
                <label class="header" style="font-weight: bold;"><?php esc_html_e('Quotation steps', WS247_QUOTE_QQFS_TEXTDOMAIN); ?></label>
            </div>
            <?php 
            $kk = 1;
            foreach($arr_detail_option as $pt => $arr_option){
                $step_title = $arr_option['step_title'];
                $arr_step_options = $arr_option['step_options'];
                ?>
                <div class="row">
                    <label class="header2" style="font-weight: 500;text-decoration: underline;"><?php echo esc_attr($kk. ')'. $step_title); ?></label>
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
        
        <div class="group" style="margin-bottom: 20px;border: 1px solid #f0f0f1;padding: 10px 20px;">
            <div class="row">
                <label class="header" style="font-weight: bold;"><?php esc_html_e('Customer information', WS247_QUOTE_QQFS_TEXTDOMAIN); ?></label>
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
        
        <div class="group" style="margin-bottom: 20px;border: 1px solid #f0f0f1;padding: 10px 20px;">
            <div class="row">
                <label class="header" style="font-weight: bold;"><?php esc_html_e('Quotation total', WS247_QUOTE_QQFS_TEXTDOMAIN); ?></label>
            </div>
            <ul>
                <li><label><?php echo Ws247_quote_qqfs_function::quote_format_money($total, true); ?></label></li>                    
            </ul>
        </div>
    </section>
    
    <div id="email-footer" style="background: #f58634;padding: 5px 20px;float: left; width: 100%;text-align: center;color: #fff;">
        © Copyright <?php echo date('Y'); ?>. <?php esc_html_e('Quote sent from Website:', WS247_QUOTE_QQFS_TEXTDOMAIN); ?> <a href="<?php echo get_site_url(); ?>" target="_blank" rel="nofollow"><?php echo $domain;?></a>
    </div>        
</div>