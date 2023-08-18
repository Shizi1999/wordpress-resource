<?php do_action( 'qqfs_before_form' ); ?>

<div class="qqfs-12 qqfs-sm-6 qqfs-md-6">
    <div class="mb-3">
      <input type="text" class="form-control req" id="name" aria-describedby="req-name" placeholder="<?php esc_html_e('Your name', WS247_QUOTE_QQFS_TEXTDOMAIN);?>*">
      <div id="req-name" class="invalid-feedback"><?php esc_html_e('Required field to enter', WS247_QUOTE_QQFS_TEXTDOMAIN);?></div>
    </div>
</div>

<?php do_action( 'qqfs_after_name' ); ?>

<div class="qqfs-12 qqfs-sm-6 qqfs-md-6">
    <div class="mb-3">
      <input type="text" class="form-control req" id="phone" aria-describedby="req-phone" placeholder="<?php esc_html_e('Your phone', WS247_QUOTE_QQFS_TEXTDOMAIN);?>*">
      <div id="req-phone" class="invalid-feedback"><?php esc_html_e('Required field to enter', WS247_QUOTE_QQFS_TEXTDOMAIN);?></div>
    </div>
</div>

<?php do_action( 'qqfs_after_phone' ); ?>

<div class="qqfs-12 qqfs-sm-6 qqfs-md-6">
    <div class="mb-3">
      <input type="email" class="form-control req" id="email" aria-describedby="req-email" placeholder="<?php esc_html_e('Your email', WS247_QUOTE_QQFS_TEXTDOMAIN);?>*">
      <div id="req-email" class="invalid-feedback"><?php esc_html_e('Required field to enter', WS247_QUOTE_QQFS_TEXTDOMAIN);?></div>
    </div>
</div>

<?php do_action( 'qqfs_after_email' ); ?>

<div class="qqfs-12 qqfs-sm-6 qqfs-md-6">
    <div class="mb-3">
      <input type="text" class="form-control" id="company" placeholder="<?php esc_html_e('Company name', WS247_QUOTE_QQFS_TEXTDOMAIN);?>">
    </div>
</div>

<?php do_action( 'qqfs_after_company' ); ?>

<div class="qqfs-12">
    <div class="mb-3">
      <textarea class="form-control" placeholder="<?php esc_html_e('Leave message', WS247_QUOTE_QQFS_TEXTDOMAIN);?>" id="mes" style="height: 100px"></textarea>
    </div>
</div>

<?php do_action( 'qqfs_after_form' ); ?>