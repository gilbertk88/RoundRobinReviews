<?php

/**
 * Plugin Name: Round Robin Review (Premium)
 * Plugin URI: https://exclusivewebmarketing.com/round-ribon-review
 * Description: Boost Your Online Reputation with a Review Distributor for WordPress - Distribute Positive Google Reviews, Redirect Negative Reviews, and Rank Higher on Location-Based Searches
 * Version: 1.1.0
 * Update URI: https://api.freemius.com
 * Author: Exclusive web marketing
 * Author URI: https://exclusivewebmarketing.com/
 * Text Domain: exclusive-web-marketing-round-robin
 * Domain Path: /languages/
 * License: GPLv2 or any later version
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @package WPBDP
*/

if ( !function_exists( 'xc_fs_rr' ) ) {
    // Create a helper function for easy SDK access.
    function xc_fs_rr()
    {
        global  $xc_fs_rr ;
        
        if ( !isset( $xc_fs_rr ) ) {
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $xc_fs_rr = fs_dynamic_init( array(
                'id'               => '9890',
                'slug'             => 'RoundRobinReviews',
                'premium_slug'     => 'RoundRobinReview-premium',
                'type'             => 'plugin',
                'public_key'       => 'pk_aaf36a14c8e7377b8319e4ad667bc',
                'is_premium'       => true,
                'is_premium_only'  => true,
                'has_addons'       => false,
                'has_paid_plans'   => true,
                'is_org_compliant' => false,
                'trial'            => array(
                'days'               => 14,
                'is_require_payment' => true,
            ),
                'menu'             => array(
                'slug'    => 'round-robin-review',
                'support' => false,
            ),
                'is_live'          => true,
            ) );
        }
        
        return $xc_fs_rr;
    }
    
    // Init Freemius.
    xc_fs_rr();
    // Signal that SDK was initiated.
    do_action( 'xc_fs_rr_loaded' );
}

define( 'EWM_RR_HOME', plugin_dir_url( __FILE__ ) );

// Do not allow direct access to this file.
// Process images
add_action( 'admin_enqueue_scripts', 'ewm_rrr_load_admin_resources' );
function ewm_rrr_load_admin_resources( $options )
{
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'ewm-rr-main-lib-uploader-js', plugins_url( basename( dirname( __FILE__ ) ) . '/assets/js/admin-script.js', 'jquery' ) );
    wp_localize_script( 'ewm-rr-main-lib-uploader-js', 'ajax_object', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
    ) );
    wp_enqueue_style( 'ewm-rr-_style_public', plugins_url( basename( dirname( __FILE__ ) ) . '/assets/css/admin-style.css' ) );
}

add_action( 'wp_enqueue_scripts', 'ewm_rrr_load_public_resources' );
function ewm_rrr_load_public_resources( $options )
{
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'ewm-rrr-public-main-lib-uploader-js', plugins_url( basename( dirname( __FILE__ ) ) . '/assets/js/public-script.js', 'jquery' ) );
    wp_localize_script( 'ewm-rrr-public-main-lib-uploader-js', 'ajax_object', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
    ) );
    wp_enqueue_style( 'ewm-rrr-style_public', plugins_url( basename( dirname( __FILE__ ) ) . '/assets/css/public-style.css' ) );
}

function ewm_rr_add_listing_post_data( $args = array() )
{
    $current_user_id = get_current_user_id();
    $rr_rotation_manager_post_id = get_option( 'rr_rotation_manager_post_id' );
    if ( $rr_rotation_manager_post_id ) {
        return $rr_rotation_manager_post_id;
    }
    // Add mapping to see were a product relate to the other
    // Add new product if the product does not exist => Update the old product of the product already exist // Add Post
    $args_name = 'rr_company_name';
    $content_slug = preg_replace( '#[ -]+#', '-', $args_name );
    // Create post
    $post_data = [
        "post_author"           => $current_user_id,
        "post_date"             => date( 'Y-m-d H:i:s' ),
        "post_date_gmt"         => date( 'Y-m-d H:i:s' ),
        "post_content"          => 'description',
        "post_title"            => $args_name,
        "post_excerpt"          => $args_name,
        "post_status"           => "publish",
        "comment_status"        => "open",
        "ping_status"           => "closed",
        "post_password"         => "",
        "post_name"             => $args_name,
        "to_ping"               => "",
        "pinged"                => "",
        "post_modified"         => date( 'Y-m-d H:i:s' ),
        "post_modified_gmt"     => date( 'Y-m-d H:i:s' ),
        "post_content_filtered" => "",
        "post_parent"           => 0,
        "guid"                  => "",
        "menu_order"            => 0,
        "post_type"             => "round_rebon_company",
        "post_mime_type"        => "",
        "comment_count"         => "0",
        "filter"                => "raw",
    ];
    global  $wp_error ;
    $new_post_data = [
        'post_id'     => '',
        'post_is_new' => '',
    ];
    $new_post_id = '';
    
    if ( $args['company_post_id'] == 0 ) {
        $new_post_id = wp_insert_post( $post_data, $wp_error );
        $new_post_data['post_id'] = $new_post_id;
        $new_post_data['post_is_new'] = true;
    } else {
        $new_post_id = $args['company_post_id'];
        $new_post_data['post_id'] = $new_post_id;
        $new_post_data['post_is_new'] = false;
        // do product post update
        $post_data['ID'] = $new_post_id;
        wp_update_post( $post_data );
    }
    
    add_option( 'rr_rotation_manager_post_id', $new_post_id );
    return $new_post_data;
}

function ewm_rr_add_listing_meta_d( $args = array() )
{
    // Create Metadata
    $meta_arr_box = '';
    $post_id = $args['company_post_id'];
    $meta_key = 'rr_link_list';
    $meta_value = maybe_serialize( [
        'location_address'     => $args['location_address'],
        'location_link'        => $args['location_link'],
        'location_link_mobile' => $args['location_link_mobile'],
    ] );
    $meta_arr_box = add_post_meta( $post_id, $meta_key, $meta_value );
    return $meta_arr_box;
}

function ewm_rr_update_listing_meta_d( $args = array() )
{
    $round_robin_company_id = ewm_rr_add_listing_post_data();
    
    if ( $round_robin_company_id > 0 ) {
        // Get meta data
        $post_list_meta = get_post_meta( $round_robin_company_id );
        if ( array_key_exists( 'rr_link_list', $post_list_meta ) ) {
            $post_link_list = $post_list_meta['rr_link_list'];
        }
    }
    
    $last_id = $_POST['ewm_data_line_edit_id'];
    $previous_value = maybe_unserialize( $post_link_list[$_POST['ewm_data_line_edit_id']] );
    // Create Metadata
    $meta_arr_box = '';
    $post_id = get_option( 'rr_rotation_manager_post_id' );
    //$args['company_post_id'];
    $meta_key = 'rr_link_list';
    // var_dump( $previous_value ) ;
    $meta_value = maybe_serialize( [
        'location_address'     => $args['location_address'],
        'location_link'        => $args['location_link'],
        'location_link_mobile' => $args['location_link_mobile'],
    ] );
    $meta_arr_box = update_post_meta(
        $post_id,
        $meta_key,
        $meta_value,
        $previous_value
    );
    return $meta_arr_box;
}

function ewm_rr_get_next_index( $args )
{
    // get last index
    $rr_index_details = get_option( 'rr_index_details_' . $args['company_id'] );
    
    if ( !$rr_index_details ) {
        add_option( 'rr_index_details_' . $args['company_id'], 0 );
        $rr_index_details = 0;
    }
    
    // if index does not exist
    return $rr_index_details;
}

function ewm_rr_move_to_the_next_index( $args )
{
    $company_link_list = count( $args['company_link_list'] );
    $rr_index_details = get_option( 'rr_index_details_' . $args['company_id'] );
    
    if ( $rr_index_details == $company_link_list - 1 ) {
        update_option( 'rr_index_details_' . $args['company_id'], 0 );
    } else {
        $rr_index_details = $rr_index_details + 1;
        update_option( 'rr_index_details_' . $args['company_id'], $rr_index_details );
    }

}

function ewm_rr_rotation_manager()
{
    $rr_rotation_manager = get_option( 'rr_rotation_manager_post_id' );
    $args['rr_rotation_link'] = $rr_rotation_manager;
    // get current business link list
    $rr_rotation_link = get_post_meta( $rr_rotation_manager, 'rr_link_list' );
    
    if ( count( $rr_rotation_link ) == 0 ) {
        echo  'There are no links fo this business' ;
    } else {
        $links_to_evaluate = [];
        // get next link to work
        foreach ( $rr_rotation_link as $arr_key => $rr_value ) {
            $arr_details = maybe_unserialize( maybe_unserialize( $rr_value ) );
            $links_to_evaluate[$arr_key] = ( wp_is_mobile() ? $arr_details['location_link_mobile'] : $arr_details['location_link'] );
        }
        // select the next link
        $link_index = ewm_rr_get_next_index( [
            'company_link_list' => $links_to_evaluate,
            'company_id'        => $args['rr_rotation_link'],
        ] );
        // redirect using php
        
        if ( array_key_exists( $link_index, $links_to_evaluate ) ) {
            $link_to_redirect = $links_to_evaluate[$link_index];
        } else {
            $link_to_redirect = $links_to_evaluate[0];
        }
        
        if ( is_string( $link_to_redirect ) ) {
            // select redirect to next index
            ewm_rr_move_to_the_next_index( [
                'company_link_list' => $links_to_evaluate,
                'company_id'        => $args['rr_rotation_link'],
            ] );
        }
        // header( "Location: http://domain.com/redirect" ) ; //". $link_to_redirect );
        echo  '
        <script type="text/javascript">

            window.location.href = "' . $link_to_redirect . '"

        </script>' ;
        wp_die();
    }
    
    // return 'https://htm.com/?'.$_GET[ 'rr_rotation_link' ] ;
}

function ewm_rr_rotation_redirect_to_filter()
{
    $filter_page_id = get_option( 'ewm_rrr_filter_page_id' );
    $post_arr = get_post( $filter_page_id, 'ARRAY_A' );
    $link_to_redirect = $post_arr['guid'];
    echo  '
    <script type="text/javascript">

        window.location.href = "' . $link_to_redirect . '"

    </script>' ;
    wp_die();
}

function ewm_rrr_activate_rotation_action()
{
    $admin_details = strpos( $_SERVER["REQUEST_URI"], 'run-rotation-link' );
    if ( $admin_details !== false ) {
        // Forward link to google
        ewm_rr_rotation_manager();
    }
}

add_action( 'init', 'ewm_rrr_activate_rotation_action' );
// add_shortcode( 'tag_name_details' , 'rr_rotation_manager_init' ) ;
function ewm_rr_rotation_manager_init( $atts = array() )
{
    $admin_details = strpos( $_SERVER["REQUEST_URI"], 'leave-us-a-review' );
    
    if ( $admin_details !== false ) {
        // http://workshop-1.com/leave-us-a-review
        // if filter is activated? filter : forward to google link
        $is_filter_active = get_option( 'ewm_rrr_active_hh_filter_page' );
        
        if ( $is_filter_active == 'true' ) {
            // Do Filter
            ewm_rr_rotation_redirect_to_filter();
        } else {
            // Forward link to google
            ewm_rr_rotation_manager();
        }
    
    }

}

add_action( 'init', 'ewm_rr_rotation_manager_init' );
// add_action( 'admin_menu', 'rr_my_admin_menu' ) ;
function ewm_rr_my_admin_page_contents()
{
    ?>

    <div class="wrap">
        <h1 class="wp-heading-inline">
            <?php 
            esc_html_e( 'Rotation Links', 'exclusive-web-marketing-round-robin' );
            ?>
        </h1>

        <a href="<?php 
            echo  admin_url() ;
        ?>admin.php?page=round-robin-new&round-robin-company-id=0" class="page-title-action">Add new company</a>
        <hr class="wp-header-end">

        <?php 
            // return '';
            include dirname( __FILE__ ) . '/templates/custom_url.php';
        ?>
                
        <div id="ajax-response"></div>
        <div class="clear"></div>

    </div>

    <?php 
}

function rrr_should_we_do_the_onboard_redirect()
{
    $do_onboard_redirect = false;
    $rr_rotation_manager_post_id = get_option( 'rr_rotation_manager_post_id' );
    if ( array_key_exists( 'page', $_GET ) ) {
        if ( $_GET['page'] == 'round-robin-review' || $_GET['page'] == 'round-robin-review-form-input' ) {
            if ( !is_string( $rr_rotation_manager_post_id ) ) {
                // TODO add ! in front of $rr_rotation_manager_post_id!
                $do_onboard_redirect = true;
            }
        }
    }
    return $do_onboard_redirect;
}

add_action( 'init', 'rrr_client_onboarding' );
function rrr_client_onboarding()
{
    
    if ( rrr_should_we_do_the_onboard_redirect() ) {
        $url = admin_url() . 'admin.php?page=round-robin-review-onboard';
        echo  '
    <script type="text/javascript">
        window.location.href = "' . $url . '";
    </script>' ;
        wp_die();
    }

}

add_action( 'admin_menu', 'ewm_rrr_add_sub_menu' );
function ewm_rrr_add_sub_menu()
{
    /*
        add_submenu_page(
    
            'round-robin-review',
            'Dashboard',
            'Dashboard',
            'manage_options',
            'round-robin-review-d',
            'ewm_rr_my_admin_page_new_contents',
            1
    
        );
    */
}

function ewm_rr_round_robin_review_onboard()
{
    require_once dirname( __FILE__ ) . '/templates/admin/onboard.php';
}

// New company
function ewm_rr_my_edit_admin_menu()
{
    add_menu_page(
        __( 'Rotation Links', 'exclusive-web-marketing-round-robin' ),
        __( 'Rotation Links', 'exclusive-web-marketing-round-robin' ),
        'manage_options',
        'round-robin-review',
        'ewm_rr_my_admin_page_new_contents',
        'dashicons-image-filter',
        3
    );
    add_submenu_page(
        'round-robin-review',
        'Customer Feedback',
        'Customer Feedback',
        'manage_options',
        'round-robin-review-form-input',
        'ewm_rr_round_robin_review_form_input',
        2
    );
    add_submenu_page(
        'round-robin-review',
        'Settings',
        'Settings',
        'manage_options',
        'round-robin-review-onboard',
        'ewm_rr_round_robin_review_onboard',
        4
    );
}

function ewm_rr_round_robin_review_form_input()
{
    $args = array(
        'numberposts' => 9,
        'post_type'   => 'ewm_rrr_review_form',
    );

    $form_review = get_posts( $args );

    include dirname(__FILE__) . '/templates/admin/review_filter_admin.php';

}

add_action( 'admin_menu', 'ewm_rr_my_edit_admin_menu' );
function ewm_rr_my_admin_page_new_contents(){

    $post_link_list = [];
    $round_robin_company_id = ewm_rr_add_listing_post_data();

    if ( $round_robin_company_id > 0 ) {
        // Get meta data
        $post_list_meta = get_post_meta( $round_robin_company_id );
        
        if ( array_key_exists( 'rr_link_list', $post_list_meta ) ) {
            $post_link_list = $post_list_meta['rr_link_list'];
        } else {
            $post_link_list = [];
        }
    
    } else {
        // Location list
        $round_robin_company_id;
    }
    
    $get_post_list = get_post( $round_robin_company_id );
    
    if ( is_object( $get_post_list ) ) {
        $company_name = $get_post_list->post_title;
    } else {
        $company_name = '';
    }

    include dirname(__FILE__) . '/templates/admin/dashboard.php';

}

add_shortcode( 'ewm_rrr_happy_n_happy', 'ewm_rrr_happy_n_happy' );
function ewm_rrr_happy_n_happy(){
    ob_start();
        include dirname(__FILE__) . '/templates/happy_unhappy_filter.php';
    return ob_get_clean();
}

add_shortcode( 'ewm_rrr_review_form', 'ewm_rrr_review_form' );
function ewm_rrr_review_form()
{
    ob_start();
        include dirname( __FILE__ ) . '/templates/filter_review_form.php';
    return ob_get_clean();
}

function ewm_rrr_create_post_filter()
{
    $current_user_id = get_current_user_id();
    $post_data = [
        "post_author"           => $current_user_id,
        "post_date"             => date( 'Y-m-d H:i:s' ),
        "post_date_gmt"         => date( 'Y-m-d H:i:s' ),
        "post_content"          => '[ewm_rrr_happy_n_happy]',
        "post_title"            => 'Happy/ Not Happy',
        "post_excerpt"          => 'Happy/ Not Happy',
        "post_status"           => "publish",
        "comment_status"        => "open",
        "ping_status"           => "closed",
        "post_password"         => "",
        "post_name"             => 'Happy/ Not Happy',
        "to_ping"               => "",
        "pinged"                => "",
        "post_modified"         => date( 'Y-m-d H:i:s' ),
        "post_modified_gmt"     => date( 'Y-m-d H:i:s' ),
        "post_content_filtered" => "",
        "post_parent"           => 0,
        "guid"                  => "",
        "menu_order"            => 0,
        "post_type"             => "page",
        "post_mime_type"        => "",
        "comment_count"         => "0",
        "filter"                => "raw",
    ];
    global  $wp_error ;
    $post_id = wp_insert_post( $post_data, $wp_error );
    // wp_update_post( $post_data );
    return $post_id;
}

function ewm_rrr_create_new_post()
{
    $current_user_id = 0;
    $post_data = [
        "post_author"           => $current_user_id,
        "post_date"             => date( 'Y-m-d H:i:s' ),
        "post_date_gmt"         => date( 'Y-m-d H:i:s' ),
        "post_content"          => 'Review Form submission',
        "post_title"            => 'Review Form submission',
        "post_excerpt"          => 'Review Form submission',
        "post_status"           => "publish",
        "comment_status"        => "open",
        "ping_status"           => "closed",
        "post_password"         => "",
        "post_name"             => 'Review Form submission',
        "to_ping"               => "",
        "pinged"                => "",
        "post_modified"         => date( 'Y-m-d H:i:s' ),
        "post_modified_gmt"     => date( 'Y-m-d H:i:s' ),
        "post_content_filtered" => "",
        "post_parent"           => 0,
        "guid"                  => "",
        "menu_order"            => 0,
        "post_type"             => "ewm_rrr_review_form",
        "post_mime_type"        => "",
        "comment_count"         => "0",
        "filter"                => "raw",
    ];
    global  $wp_error ;
    $post_id = wp_insert_post( $post_data, $wp_error );
    return $post_id;
}

add_action( "wp_ajax_nopriv_ewm_rrr_delete_single_review_e", "ewm_rrr_delete_single_review_e" );
add_action( "wp_ajax_ewm_rrr_delete_single_review_e", "ewm_rrr_delete_single_review_e" );
function ewm_rrr_delete_single_review_e()
{
    wp_delete_post( $_POST['ewm_rrr_f_review_id'], true );
    echo  json_encode( $_POST ) ;
    wp_die();
}

add_action( "wp_ajax_nopriv_ewm_rrr_submit_review_form", "ewm_rrr_submit_review_form" );
add_action( "wp_ajax_ewm_rrr_submit_review_form", "ewm_rrr_submit_review_form" );
function ewm_rrr_submit_review_form()
{
    $form_details = [
        'ewm_rrr_f_name_company_name' => $_POST['ewm_rrr_f_name_company_name'],
        'ewm_rrr_f_phone_number'      => $_POST['ewm_rrr_f_phone_number'],
        'ewm_rrr_f_email'             => $_POST['ewm_rrr_f_email'],
        'ewm_rrr_f_invoice_number'    => $_POST['ewm_rrr_f_invoice_number'],
    ];
    // create new post.
    $ewm_rrr_new_post_id = ewm_rrr_create_new_post();
    // add meta data
    foreach ( $form_details as $meta_key => $meta_value ) {
        add_post_meta( $ewm_rrr_new_post_id, $meta_key, $meta_value );
    }
    echo  json_encode( $_POST ) ;
    wp_die();
}

add_action( "wp_ajax_nopriv_ewm_rrr_update_huh_active", "ewm_rrr_update_huh_active" );
add_action( "wp_ajax_ewm_rrr_update_huh_active", "ewm_rrr_update_huh_active" );
function ewm_rrr_update_huh_active()
{
    // Update
    update_option( 'ewm_rrr_active_hh_filter_page', $_POST['ewm_rrr_active_hh_status'] );
    echo  json_encode( [
        'active_status' => $_POST['ewm_rrr_active_hh_status'],
    ] ) ;
    wp_die();
}

add_action( "wp_ajax_nopriv_ewm_rrr_update_ff_active", "ewm_rrr_update_ff_active" );
add_action( "wp_ajax_ewm_rrr_update_ff_active", "ewm_rrr_update_ff_active" );
function ewm_rrr_update_ff_active()
{
    // Update
    update_option( 'ewm_rrr_active_ff_page', $_POST['ewm_rrr_active_ff_status'] );
    echo  json_encode( [
        'active_status' => $_POST['ewm_rrr_active_ff_status'],
    ] ) ;
    wp_die();
}

function ewm_rrr_create_ff_post()
{
    $current_user_id = get_current_user_id();
    $post_data = [
        "post_author"           => $current_user_id,
        "post_date"             => date( 'Y-m-d H:i:s' ),
        "post_date_gmt"         => date( 'Y-m-d H:i:s' ),
        "post_content"          => '[ewm_rrr_review_form]',
        "post_title"            => 'Review Form',
        "post_excerpt"          => 'Review Form',
        "post_status"           => "publish",
        "comment_status"        => "open",
        "ping_status"           => "closed",
        "post_password"         => "",
        "post_name"             => 'Review Form',
        "to_ping"               => "",
        "pinged"                => "",
        "post_modified"         => date( 'Y-m-d H:i:s' ),
        "post_modified_gmt"     => date( 'Y-m-d H:i:s' ),
        "post_content_filtered" => "",
        "post_parent"           => 0,
        "guid"                  => "",
        "menu_order"            => 0,
        "post_type"             => "page",
        "post_mime_type"        => "",
        "comment_count"         => "0",
        "filter"                => "raw",
    ];
    global  $wp_error ;
    $post_id = wp_insert_post( $post_data, $wp_error );
    // wp_update_post( $post_data );
    return $post_id;
}

add_action( "wp_ajax_nopriv_ewm_rrr_update_ff_create", "ewm_rrr_update_ff_create" );
add_action( "wp_ajax_ewm_rrr_update_ff_create", "ewm_rrr_update_ff_create" );
function ewm_rrr_update_ff_create()
{
    // If the option did not work
    $ff_page_id = 0;
    // delete_option('ewm_rrr_filter_page_id');
    // Check options if the filter page exists? If the options exist, update and replay: create option
    $ff_page_id = get_option( 'ewm_rrr_ff_page_id' );
    
    if ( !is_string( $ff_page_id ) ) {
        $ff_page_id = ewm_rrr_create_ff_post();
        // Create new page filter id
        add_option( 'ewm_rrr_ff_page_id', $ff_page_id );
        add_option( 'ewm_rrr_active_ff_page', 'false' );
    }
    
    echo  json_encode( get_post( $ff_page_id, 'ARRAY_A' ) ) ;
    wp_die();
}

add_action( "wp_ajax_nopriv_ewm_rrr_update_hh_active_post_id", "ewm_rrr_update_hh_active_post_id" );
add_action( "wp_ajax_ewm_rrr_update_hh_active_post_id", "ewm_rrr_update_hh_active_post_id" );
function ewm_rrr_update_hh_active_post_id()
{
    update_option( 'ewm_rrr_filter_page_id', $_POST['ewm_rrr_hh_post_id'] );
    echo  json_encode( [] ) ;
    wp_die();
}

add_action( "wp_ajax_nopriv_ewm_rrr_update_ff_active_post_id", "ewm_rrr_update_ff_active_post_id" );
add_action( "wp_ajax_ewm_rrr_update_ff_active_post_id", "ewm_rrr_update_ff_active_post_id" );
function ewm_rrr_update_ff_active_post_id()
{
    update_option( 'ewm_rrr_ff_page_id', $_POST['ewm_rrr_ff_post_id'] );
    echo  json_encode( [] ) ;
    wp_die();
}

add_action( "wp_ajax_nopriv_ewm_rrr_create_filter_page", "ewm_rrr_create_filter_page" );
add_action( "wp_ajax_ewm_rrr_create_filter_page", "ewm_rrr_create_filter_page" );
function ewm_rrr_create_filter_page()
{
    $filter_page_id = 0;
    // delete_option('ewm_rrr_filter_page_id');
    // Check options if the filter page exists? If the options exist, update and replay: create option
    $filter_page_id = get_option( 'ewm_rrr_filter_page_id' );
    
    if ( !is_string( $filter_page_id ) ) {
        $filter_page_id = ewm_rrr_create_post_filter();
        // Create new page filter id
        add_option( 'ewm_rrr_filter_page_id', $filter_page_id );
        add_option( 'ewm_rrr_active_hh_filter_page', false );
    }
    
    echo  json_encode( get_post( $filter_page_id, 'ARRAY_A' ) ) ;
    wp_die();
}

add_action( "wp_ajax_nopriv_wp_add_update_company", "ewm_rr_add_update_company" );
add_action( "wp_ajax_wp_add_update_company", "ewm_rr_add_update_company" );
function ewm_rr_add_update_company()
{
    $rr_company_data = ewm_rr_add_listing_post_data( $_POST );
    echo  json_encode( [
        'company_name'    => $_POST['company_name'],
        'company_post_id' => $rr_company_data['post_id'],
    ] ) ;
    wp_die();
}

add_action( "wp_ajax_nopriv_wp_add_update_address_review_link", "ewm_rr_add_update_review" );
add_action( "wp_ajax_wp_add_update_address_review_link", "ewm_rr_add_update_review" );
function ewm_rr_add_update_review(){

    $previous_value = array_key_exists( 'ewm_data_line_edit_id', $_POST );

    if( array_key_exists('is_a_new_link', $_POST ) ) {
        if ($_POST['is_a_new_link'] == '0') {
            // $_POST[ 'ewm_data_line_edit_id' ]  = trim( stripslashes( $_POST[ 'ewm_data_line_edit_id' ] ) );
            $rr_company_data = ewm_rr_update_listing_meta_d($_POST);
        } else {
            $rr_company_data = ewm_rr_add_listing_meta_d($_POST);
        }
    }
    else{
        $rr_company_data = ewm_rr_add_listing_meta_d($_POST);
    }
    
    $_POST["location_link_short"] = substr( $_POST["location_link"], 0, 30 ) . '... ';
    $_POST["location_link_mobile_short"] = substr( $_POST["location_link_mobile"], 0, 30 ) . '... ';
    
    echo  json_encode( $_POST ) ;

    wp_die();
    
}

function ewm_rr_inner_delete_link( $args = array() )
{
    $round_robin_company_id = ewm_rr_add_listing_post_data();
    
    if ( $round_robin_company_id > 0 ) {
        // Get meta data
        $post_list_meta = get_post_meta( $round_robin_company_id );
        if ( array_key_exists( 'rr_link_list', $post_list_meta ) ) {
            $post_link_list = $post_list_meta['rr_link_list'];
        }
    }
        
    if( array_key_exists( 'link_line_id' , $_POST ) ) {
        $previous_value = maybe_unserialize( $post_link_list[ $_POST['link_line_id'] ] );
    }

    $rr_link_list = delete_post_meta( $args['company_post_id'], 'rr_link_list', $previous_value );
    return $rr_link_list;
}

// wp_delete_address_review_link
add_action( "wp_ajax_nopriv_wp_delete_address_review_link", "ewm_rr_delete_link" );
add_action( "wp_ajax_wp_delete_address_review_link", "ewm_rr_delete_link" );
function ewm_rr_delete_link()
{
    $rr_company_data = ewm_rr_inner_delete_link( $_POST );
    /* echo  json_encode( [
           'link_line_id' => $_POST['link_line_id'],
       ] ) ;
       
       */
    echo  json_encode( $_POST ) ;
    wp_die();
}

function ewm_rrr_get_link_count()
{
    $round_robin_company_id = ewm_rr_add_listing_post_data();
    $number_of_links = 0;
    
    if ( $round_robin_company_id > 0 ) {
        // Get meta data
        $post_list_meta = get_post_meta( $round_robin_company_id );
        if ( array_key_exists( 'rr_link_list', $post_list_meta ) ) {
            $post_link_list = $post_list_meta['rr_link_list'];
        }
        $number_of_links = count( $post_link_list );
    }
    
    return $number_of_links;
}

function ewm_rrr_manage_plans()
{
    $plans_arr = [
        'community'    => '2',
        'professional' => '3',
        'elite'        => '10000000',
        'agency'       => '10000000',
    ];
    $ewm_rrr_current_l_limit = 2;
    
    if ( xc_fs_rr()->is_plan( 'community', true ) ) {
        $ewm_rrr_current_l_limit = $plans_arr['community'];
    } elseif ( xc_fs_rr()->is_plan( 'professional', true ) ) {
        $ewm_rrr_current_l_limit = $plans_arr['professional'];
    } elseif ( xc_fs_rr()->is_plan( 'elite', true ) ) {
        $ewm_rrr_current_l_limit = $plans_arr['elite'];
    } elseif ( xc_fs_rr()->is_plan( 'agency', true ) ) {
        $ewm_rrr_current_l_limit = $plans_arr['agency'];
    }
    
    $ewm_rrr_get_link_count = ewm_rrr_get_link_count();
    $ewm_rrr_price = xc_fs_rr()->get_upgrade_url();
    echo  '
    <script type="text/javascript">
        var ewm_rrr_current_l_count = ' . $ewm_rrr_get_link_count . ';
        var ewm_rrr_current_l_limit = ' . $ewm_rrr_current_l_limit . ';
        var ewm_rrr_price = "' . $ewm_rrr_price . '";
    </script>' ;
}

add_action( 'admin_footer', 'ewm_rrr_manage_plans' );