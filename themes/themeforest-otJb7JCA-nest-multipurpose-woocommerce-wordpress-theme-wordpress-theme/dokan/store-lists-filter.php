<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/dokan/store-lists-filter.php
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package Dokan/Templates
 * @version 2.9.30
 */

defined( 'ABSPATH' ) || exit; ?>

<?php do_action( 'dokan_before_store_lists_filter', $stores ); ?>
<div class="row">
    <div class="col-md-5 col-sm-12 m-auto">
        <div class="vendot_list_heading text-center">
            <h1 class="display-2 mb-50"><?php echo get_theme_mod('dokan_vendor_list_heading' , 'Vendors List'); ?></h1>
        </div>
        <?php ?>
<form role="store-list-filter" name="dokan_store_lists_filter_form"  class="nest_rewrite_search">

    <?php
        do_action( 'dokan_before_store_lists_filter_search', $stores );

        if ( apply_filters( 'dokan_load_store_lists_filter_search_bar', true ) ) : ?>
            <div class="store-search grid-item">
                <input type="search" class="store-search-input" name="dokan_seller_search" placeholder="<?php esc_html_e( 'Search Vendors', 'steelthemes-nest' ); ?>">
            </div>
        <?php endif;

        do_action( 'dokan_before_store_lists_filter_apply_button', $stores );
    ?>

    <div class="apply-filter">
        <!--<button id="cancel-filter-btn" class="dokan-btn dokan-btn-theme"><?php // esc_html_e( 'Cancel', 'steelthemes-nest' ); ?></button> -->
        <button id="apply-filter-btn" class="dokan-btn dokan-btn-theme" type="submit"><i class="fi-rs-search"></i></button>
    </div>

    <?php do_action( 'dokan_after_store_lists_filter_apply_button', $stores ); ?>
</form>
</div>
</div>
<div class="row">
<div class="col-md-8 col-sm-12 m-auto">
<div id="dokan-store-listing-filter-wrap">
    <?php do_action( 'dokan_before_store_lists_filter_left', $stores ); ?>
    <div class="left">
        <p class="item store-count">
            <?php 
            printf( _n( 'Total store showing: %d', 'Total stores showing: %d', $number_of_store, 'steelthemes-nest' ), number_format_i18n( $number_of_store ) );
            ?>
        </p>
    </div>

    <?php do_action( 'dokan_before_store_lists_filter_right', $stores ); ?>
    <div class="right">
        <!--  <div class="item">
            <div class="dokan-icons">
                <div class="dokan-icon-div"></div>
                <div class="dokan-icon-div"></div>
                <div class="dokan-icon-div"></div>
            </div>

          <button class="dokan-store-list-filter-button dokan-btn dokan-btn-theme">
                <?php // esc_html_e( 'Filter', 'steelthemes-nest' ); ?>
            </button>
        </div> -->

        <form name="stores_sorting" class="sort-by item" method="get">
        <i class="fi-rs-apps-sort"></i>
            <label><?php esc_html_e( 'Sort by', 'steelthemes-nest' ); ?>:</label>

            <select name="stores_orderby" id="stores_orderby" aria-label="<?php esc_html_e( 'Sort by', 'steelthemes-nest' ); ?>">
                <?php
                    foreach ( $sort_filters as $key => $filter ) {
                        $optoins = "<option value='${key}'>${filter}</option>";
                        printf( $optoins );
                    }
                ?>
            </select>
        </form>

        <div class="toggle-view item">
            <span class="dashicons dashicons-screenoptions" data-view="grid-view"></span>
            <span class="dashicons dashicons-menu-alt" data-view="list-view"></span>
        </div>
    </div>
</div>
</div>
</div>
<?php do_action( 'dokan_before_store_lists_filter_form', $stores ); ?>


