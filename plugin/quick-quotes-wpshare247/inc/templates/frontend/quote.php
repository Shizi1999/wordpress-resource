<?php 
$quote_post = get_post($quote_id);
$quote_title = $quote_post->post_title;
$post_content = apply_filters('the_content', $quote_post->post_content);
$s_post_type_list = get_post_meta($quote_id, 'quote_qqfs_pt_step', true);
$container_quoter_id = uniqid('container_quoter_id_');
?>
<div class="quote_qqfs_shortcode">
	<?php do_action( 'qqfs_before_quote' ); ?>
    
    <section id="<?php echo esc_attr($container_quoter_id);?>" class="ws247-quote-qqfs-shortcode">
        <div class="qqfs-container">
        	<?php do_action( 'qqfs_before_quote_title' ); ?>
            <h2 class="ws247-quote-qqfs-title"><?php echo esc_attr($quote_title);?></h2>
            <?php do_action( 'qqfs_before_quote_description' ); ?>
            <div class="ws247-quote-qqfs-description"><?php echo $post_content;?></div>
            <?php do_action( 'qqfs_after_quote_description' ); ?>
            <?php 
            if($s_post_type_list){
            ?>
                <div class="ws247-quote-qqfs-content">
                	<?php do_action( 'qqfs_before_quote_total' ); ?>
                    <div class="quote-qqfs-total" style="display:none;">
                        <span class="mn"><?php echo Ws247_quote_qqfs_function::quote_format_money(0, true);?></span>
                    </div>
                    <?php do_action( 'qqfs_after_quote_total' ); ?>
                    <div class="quote-qqfs-mes quote-qqfs-err" style="display:none;">
                        <div class="alert alert-danger qqfs-center" role="alert">
                          <div><?php esc_html_e('Require checked', WS247_QUOTE_QQFS_TEXTDOMAIN);?></div>
                        </div>
                    </div>
                    <?php do_action( 'qqfs_before_quote_options' ); ?>
                    <div class="steps-res qqfs-row"></div>
                    <?php do_action( 'qqfs_before_quote_buttons' ); ?>
                    <div class="qqfs-center ws247-quote-qqfs-buttons">
                        <button type="button" class="btn btn-primary js-ws247-quote-qqfs-start" 
                                 data-step="0" 
                                 data-quoteid="<?php echo esc_attr($quote_id);?>" 
                                 data-req="0" 
                                 data-container="<?php echo esc_attr($container_quoter_id);?>">
                            <span class="txt"><?php esc_html_e('Start', WS247_QUOTE_QQFS_TEXTDOMAIN);?></span>
                            <span style="display:none;" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        </button>
                    </div>
                </div>
            <?php 
            }else{
                esc_html_e('This quote currently has no steps (Option). Please go to admin for more steps to create a quote.', WS247_QUOTE_QQFS_TEXTDOMAIN);
            }
            ?>
        </div>
    </section>
    
    <?php do_action( 'qqfs_after_quote' ); ?>
</div>