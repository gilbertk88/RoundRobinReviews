jQuery(document).ready(function($) {

    is_a_new_link = '0'; // $( current_link ).attr( "data-is-new-link" ) ;

    if( typeof round_robin_company_id == 'undefined' ){

        var round_robin_company_id = 1;

    }

    $( '#new_location_link' ).click(function (e) {
        e.preventDefault();
        // Add link location address
        // display link form
    } ) ;

    $("#edit_company_name_button").click(function (e) {

        e.preventDefault();

        $("#wt_company_name_submit").attr('value','Update company name');
        $(".wt_dark_background_company" ).show() ;

    } )

    link_details_id         = 1;

    var data_line_edit_id   = 0;

    var ewm_rrr_listen_to_popup_reaction = function(){

    $('.close_box_company').click(function (e) {

        $(".wt_dark_background_company" ).hide();

    } )

    $('.close_box_address_shorten_mobile').click(function (e) {
        $('.wt_dark_background_address_shorten_mobile').hide();
    })

    $(".ewm_rr_get_mobile").click( function (e) {
        $('.wt_dark_background_address_shorten_mobile').show();
        $('.ewm_rr_mobile_list').hide();
        $('.ewm_get_desktop_url').show();
        $('.ewm_rr_step_1').click();
    } )

    $(".ewm_rr_mobile_prev").click(function() {
        // 
    });

    $(".ewm_rr_mobile_next").click(function() {
        
        ewm_rr_step_mobile = $( this ).data('ewm_rr_step_mobile');

        $('.'+ewm_rr_step_mobile ).click();

    });

    $('.ewm_rr_mobile_prev').click(function() {

        ewm_rr_step_mobile = $( this ).data('ewm_rr_step_mobile');

        $('.'+ewm_rr_step_mobile ).click();
        
    })

    $('#ewm_rrr_how_to_sh_link').click(function (e) {

        $(".wt_dark_background_address_shorten_link" ).show();

    });

    $('.close_box_address_shorten_link').click(function (e) {

        $(".wt_dark_background_address_shorten_link" ).hide();

    });

    $('.close_box_address').click(function (e) {

        $(".wt_dark_background_address" ).hide();

    } )

    $("#edit_company_address_button").click(function (e) {

        e.preventDefault();

        $("#wt_company_address_submit").attr('value','Update review link');
        $(".wt_dark_background_address" ).show() ;

    } )

        $(".edit_location_link").click( function (e){

            e.preventDefault() ;

            is_a_new_link       = '0' ; //$( current_link ).attr( "data-is-new-link" ) ;

            data_line_edit_id  = $( this ).data('line-edit-id');
            
            link_details_id     = $( this ).attr( "data-review-link-local-id" ) ;

            $( "#wt_link_to_update_link" ).val( link_details_id ) ;

            location_details    = $.trim( $( "#review_location_detail_id_"+ link_details_id ).html() );

            link_details        = $.trim( $( "#review_link_detail_id_" + link_details_id ).attr('href') );

            link_mobile_details        = $.trim( $( "#review_link_mobile_detail_id_" + link_details_id ).attr( 'href') );

            $( "#wt_location_address" ).val( location_details ) ;

            $( "#wt_review_link" ).val( link_details ) ;

            $( "#wt_review_link_mobile" ).val( link_mobile_details ) ;

            $( "#wt_company_location_submit" ).attr( 'value' , 'Edit Review Link' ) ;

            previous_value = $( this ).attr( "data-previous-data" ) ;

            $( "#wt_previous_value_link" ).attr( 'value' , previous_value ) ;

            $( ".wt_dark_background_address" ).show() ;

        } )

        $('#add_new_location_link').click(function (e) {

            e.preventDefault();
             
            if( ewm_rrr_current_l_count  >= ewm_rrr_current_l_limit ){

                $('#ewm_rrr_main_pop_content').html('Location limit reached, please support the team by upgrading, <a href="'+ewm_rrr_price+'">See Pricing</a>')

            }

            is_a_new_link = '1'; //$( current_link ).attr( "data-is-new-link" ) ;

            $("#wt_location_address").val('');
        
            $("#wt_review_link").val('');
        
            $("#wt_review_link_mobile").val('');

            $("#wt_company_location_submit").attr( 'value','Create New Review Link' );

            $(".wt_dark_background_address" ).show() ;

        } )

        $("#wt_company_location_submit").click( function (e) {

            e.preventDefault();

            $("#wt_company_location_submit").attr( 'value','Loading...' );

            add_update_review_link();

        } )

        $( '#edit_location_link' ).click(function() {

            e.preventDefault();

            $("#wt_company_address_submit").attr('value','Update');
            $(".wt_dark_background_address" ).show() ;

        } )

        $( '#edit_location_link' ).click( function (e) {

            e.preventDefault();
            // Add link location address

        } ) ;
    }

    ewm_rrr_listen_to_popup_reaction();

    $( '#edit_company_name' ).click(function (e) {

        e.preventDefault();

        // Edit company name

    } ) ;

    $('#wt_company_name_submit').click(function (e) {

        e.preventDefault();

        $("#wt_company_name_submit").attr('value','loading...');

        add_update_company();

    } )

    function add_update_company() {

        var form_data = new FormData() ;
        
        form_data.append( 'action', 'wp_add_update_company' ) ;

        form_data.append( 'company_name' , $('#wt_company_name_text').val() ) ;

        form_data.append( 'company_post_id' , $('#wt_company_name_text').attr( 'data-company-id' ) ) ;

        jQuery.ajax( {

            url: ajax_object.ajaxurl,

            type: 'post',

            contentType: false,

            processData: false,

            data: form_data,

            success: function ( response ) {

                response = JSON.parse( response ) ; 

                console.log( response.company_name +' - '+ response.company_post_id ) ;

                $( '#comp_name' ).html( response.company_name ) ;

                $('#wt_company_name_text').attr( 'data-company-id', response.company_post_id ) 

                $(".wt_dark_background_company" ).hide() ;

            },

            error: function (response) {

                console.log( response ) ;
            }

        } ) ;

    }

    function add_update_review_link(){

        var form_data = new FormData() ;
        
        form_data.append( 'action', 'wp_add_update_address_review_link' ) ;

        form_data.append( 'company_name' , $('#wt_company_name_text').val() ) ;

        form_data.append( 'company_post_id' , $('#wt_company_name_text').attr( 'data-company-id' ) ) ;

        form_data.append( 'location_address' , $('#wt_location_address').val() ) ;

        form_data.append( 'location_link' , $('#wt_review_link').val() ) ;

        form_data.append( 'location_link_mobile' , $('#wt_review_link_mobile').val() ) ;

        if( is_a_new_link == '0' ){

            form_data.append( 'link_id_update' , $( "#wt_link_to_update_link" ).val() );

            form_data.append( 'is_a_new_link' , is_a_new_link );

            form_data.append( 'ewm_data_line_edit_id' , data_line_edit_id );

        }

        jQuery.ajax( {

            url: ajax_object.ajaxurl,

            type: 'post',

            contentType: false,

            processData: false,

            data: form_data,

            success: function ( response ) {

                if( ewm_rrr_page_location == 'ewm_rrr_add_gmb_link' ){

                    window.location.search += '&ewm_rrr_current_step=ewm_rrr_add_gmb_link';

                }
                else{

                    location.reload();

                }

                $('.ewm_rrr_add_gmb_link').click();

                response = JSON.parse( response ) ; 

                if( is_a_new_link == '0' ){

                    location_links_count = parseInt( $('#location_links_count').html() );

                    location_links_count = location_links_count + 1 ;

                    $('#location_links_count').html( location_links_count );

                    link_details_id = response.link_id_update ;
                    
                    // Update relevant
                    $("#review_location_detail_id_"+ link_details_id ).html( response.location_address );

                    $("#review_link_detail_id_" + link_details_id ).html( response.location_link );

                    $("#edit_link_details_"+ link_details_id ).attr(    "data-previous-data", response.previous_value );
                    
                    $("#delete_link_details_"+ link_details_id ).attr(  'data-previous-data', response.previous_value );

                }
                else{
                    
                    // Add line at the bottom
                    address_name            = response.location_address ;
                    
                    address_link            = response.location_link ;

                    address_link_short      = response.location_link_short ;

                    address_link_mobile     = response.location_link_mobile ;

                    address_link_mobile_short = response.location_link_mobile_short ;

                    link_previous_data = 'haha' ;

                    link_index_id   = $('#location_links_count').html( location_links_count ) + 1 ; // link_details_id ;

                    // Add new link
                    $( "#the-list" ).append( '<tr class="iedit author-self level-0 post-2 type-page status-publish hentry entry" data-previous-data=`' + link_previous_data + '` id="line_location_'+ link_index_id +'"> \
                        <td class="title column-title has-row-actions column-primary page-title" data-colname="Title" data-review-link-local-id="'+ link_index_id +'" > \
                            '+ address_name +' \
                        </td> \
                        <td class="author column-author" data-colname="Author"> \
                            <a href="'+address_link+'" data-review-link-local-id="'+ link_index_id +'" >'+address_link_short+' </a> \
                        </td> \
                        <td class="author column-author" data-colname="Author"> \
                            <a href="'+address_link_mobile+'" data-review-link-local-id="'+ link_index_id +'" >'+address_link_mobile_short+' </a> \
                        </td> \
                        <td class="date column-date" data-colname="Date"> \
                            <a href="" data-review-link-local-id="'+ link_index_id +'" data-previous-data= `' + link_previous_data + '` class="edit_location_link" data-is-new-link="0" > \
                                Edit \
                            </a> \
                            |\
                            <a href="" data-review-link-local-id="'+ link_index_id +'" data-previous-data=`' + link_previous_data + '` data-link-id="'+ link_index_id +'" class="delete_location_link" > \
                                Delete \
                            </a>\
                        </td>\
                    </tr>' ) ;

                }
            
                $(".wt_dark_background_address" ).hide() ;

            },

            error: function (response) {

                console.log( response ) ;
            }

        } ) ;

    }

    function delete_location_link( current_link ) {

        $( current_link ).html( '<span style="font-size:10px;">Deleting...</span>' ) ;

        var form_data = new FormData() ;
        
        form_data.append( 'action', 'wp_delete_address_review_link' ) ;

        form_data.append( 'company_name' , $( '#wt_company_name_text' ).val() ) ;

        form_data.append( 'company_post_id' , $( '#wt_company_name_text' ).attr( 'data-company-id' ) ) ;

        form_data.append( 'previous_data' , $( current_link ).attr( 'data-previous-data' ) ) ;

        form_data.append( 'link_line_id' , $( current_link ).attr( 'data-link-id' ) ) ;
        
        jQuery.ajax( {

            url: ajax_object.ajaxurl,

            type: 'post',

            contentType: false,

            processData: false,

            data: form_data,

            success: function ( response ) {

                console.log( response ) ;

                response = JSON.parse( response ) ;

                link_location = '#line_location_' + response.link_line_id ;

                location_links_count = parseInt( $('#location_links_count').html() ) ;

                location_links_count = location_links_count - 1 ;

                $('#location_links_count').text( location_links_count ) ;

                $( link_location ).remove() ;

            } ,

            error: function ( response ) {

                console.log( response ) ;
            
            }

        } ) ;

    }

    $('.delete_location_link').click(function( e ){
        
        e.preventDefault();

        delete_location_link( this ) ;

    } )

    if( round_robin_company_id == 0 ){
    
        $(".wt_dark_background_company" ).show() ;
    
    }

	var ewm_rrr_focus_color = '#008000c8';
    var ewm_rrr_focus_text_color = '#fff';

	var ewm_rrr_blur_color = '#ffffff';
    var ewm_rrr_blur_text_color = '#333';

    var ewm_rrr_happy_unhapppy_page = 0 ;
    var ewm_rrr_happy_unhapppy_active = 0 ;

    var ewm_rrr_feedbackform_page = 0 ;
    var ewm_rrr_feedbackform_active = 0 ;
    
    function ewm_rrr_create_filter_page(){

        var form_data = new FormData() ;
        
        form_data.append( 'action', 'ewm_rrr_create_filter_page' );

        jQuery.ajax({

            url: ajax_object.ajaxurl,
            type: 'post',
            contentType: false,
            processData: false,
            data: form_data,

            success: function ( response ) {

                console.log( response );

                response = jQuery.parseJSON( response ) ;

                ew_rrrpage_link = '<a href="'+response.guid+'">'+ response.post_title +'</a>'

                $('.ewm_rrr_huh_sec').html( ew_rrrpage_link );

                ewm_rrr_happy_unhapppy_page = response.filter_page_id;

            },
            error: function (response) {

                console.log( response ) ;

            }

        });

    }

    function ewm_rrr_replace_button_with_filter_dropdown(){

        // TODO: add dropdown to replace the the button

    }

    function ewm_rrr_update_the_active_not_active_filter_page( args ){

        // TODO: update local settings to update
        ewm_rrr_happy_unhapppy_active = args;

        // TODO: update server settings
        var form_data = new FormData();

        form_data.append( 'ewm_rrr_active_hh_status', ewm_rrr_happy_unhapppy_active );
        
        form_data.append( 'action', 'ewm_rrr_update_huh_active' );

        jQuery.ajax({
            url: ajax_object.ajaxurl,
            type: 'post',
            contentType: false,
            processData: false,
            data: form_data,

            success: function ( response ) {

                console.log( response );

                // response = jQuery.parseJSON( response );

            },
            error: function (response) {

                console.log( response ) ;

            }

        });

    }

    function ewm_rrr_create_ff_page(){
        // TODO update on the local
        // ewm_rrr_feedbackform_page
        // TODO update server settings
       // ewm_rrr_replace_button_with_ff_dropdown()

       var form_data = new FormData();

       form_data.append( 'action', 'ewm_rrr_update_ff_create' );

       jQuery.ajax({

            url: ajax_object.ajaxurl,
            type: 'post',
            contentType: false,
            processData: false,
            data: form_data,

            success: function ( response ) {

                console.log( response );

                response = jQuery.parseJSON( response ) ;

                ew_rrrpage_link = '<a href="'+response.guid+'">'+ response.post_title +'</a>'

                $('#ewm_rrr_ff_parent').html( ew_rrrpage_link );

                ewm_rrr_happy_unhapppy_page = response.filter_page_id;

            },
            error: function (response) {

                console.log( response ) ;

            }

        });
    }

    // replace the button with a dropdown
    function ewm_rrr_replace_button_with_ff_dropdown(){
        // TODO replace the button with a dropdown
    }

    function ewm_rrr_update_the_active_not_active_ff_page( args ){

        // TODO update local record
        // TODO update server record

        // TODO: update local settings to update
        ewm_rrr_feedbackform_active = args;

        // TODO: update server settings
        var form_data = new FormData();

        form_data.append( 'ewm_rrr_active_ff_status', ewm_rrr_feedbackform_active );
        
        form_data.append( 'action', 'ewm_rrr_update_ff_active' );

        jQuery.ajax({

            url: ajax_object.ajaxurl,
            type: 'post',
            contentType: false,
            processData: false,
            data: form_data,
            success: function ( response ) {

                console.log( response );

            },
            error: function (response) {

                console.log( response ) ;

            }

        });

    }

    var ewm_rrr_page_location = '' ;

    //window.location.search += '&ewm_rrr_current_step=ewm_rrr_add_gmb_link';

	function ewm_rrr_activate_h_n_h_step(){

		$("#ewm_rr_main_content_det").html(

			$( '#ewm_rrr_happy_not_happy_body').html()

		);

        // window.location.search += '&ewm_rrr_current_step=ewm_rrr_happy_not_happy';
        
		$( ".ewm_rrr_happy_not_happy" ).css({ "background": ewm_rrr_focus_color , "color" : ewm_rrr_focus_text_color });
		$(".ewm_rrr_add_gmb_link").css({ "background": ewm_rrr_blur_color , "color" : ewm_rrr_blur_text_color });
		$(".ewm_rrr_form").css({ "background": ewm_rrr_blur_color , "color" : ewm_rrr_blur_text_color });
		$(".ewm_rrr_thank_you").css({ "background": ewm_rrr_blur_color , "color" : ewm_rrr_blur_text_color });

        $('#h_un_h_activation_button').click(function (){
            
            // create filter page on server
            ewm_rrr_create_filter_page();

            // replace the button with a dropdown
            ewm_rrr_replace_button_with_filter_dropdown();

        });

        $('#ewm_rrr_active_hh_filter_page').click(function(){

            ewm_rrr_update_the_active_not_active_filter_page( $(this).is(':checked') );

        });

	}

	function ewm_rrr_activate_google_links(){

		$("#ewm_rr_main_content_det").html(
			$( '#ewm_rrr_add_gmb_link_body').html()
		);

        ewm_rrr_page_location = 'ewm_rrr_add_gmb_link' ;
        //window.location.search += '&ewm_rrr_current_step=ewm_rrr_add_gmb_link';
		$('.ewm_rrr_add_gmb_link').css({ "background": ewm_rrr_focus_color , "color": ewm_rrr_focus_text_color });
		$(".ewm_rrr_happy_not_happy").css({ "background": ewm_rrr_blur_color , "color" : ewm_rrr_blur_text_color });
		$(".ewm_rrr_form").css({ "background": ewm_rrr_blur_color , "color" : ewm_rrr_blur_text_color });
		$(".ewm_rrr_thank_you").css({ "background": ewm_rrr_blur_color , "color" : ewm_rrr_blur_text_color });

		ewm_rrr_listen_to_popup_reaction();

	}

	function ewm_rrr_activate_feedback_form(){

		$("#ewm_rr_main_content_det").html(
			$( '#ewm_rrr_form_body').html()
		);

		$(".ewm_rrr_form").css({ "background": ewm_rrr_focus_color , "color" : ewm_rrr_focus_text_color });
		$(".ewm_rrr_add_gmb_link").css({ "background": ewm_rrr_blur_color , "color" : ewm_rrr_blur_text_color });
		$(".ewm_rrr_happy_not_happy").css({ "background": ewm_rrr_blur_color , "color" : ewm_rrr_blur_text_color });
		$(".ewm_rrr_thank_you").css({ "background": ewm_rrr_blur_color , "color" : ewm_rrr_blur_text_color });

        $('#rrr_ff_activation_button').click(function (){
            // create filter page on server
            ewm_rrr_create_ff_page();
        } );

        $('#ewm_rrr_active_ff_filter_page').click(function(){
            ewm_rrr_update_the_active_not_active_ff_page( $(this).is(':checked') );
        } );
		
	}

	function ewm_rrr_activate_thank_you(){

		$("#ewm_rr_main_content_det").html(
			$( '#ewm_rrr_thank_you_body').html()
		);

		$( '.ewm_rrr_thank_you' ).css({ "background": ewm_rrr_focus_color , "color" : ewm_rrr_focus_text_color });
		$(".ewm_rrr_add_gmb_link").css({ "background": ewm_rrr_blur_color, "color" : ewm_rrr_blur_text_color  });
		$(".ewm_rrr_form").css({ "background": ewm_rrr_blur_color , "color" : ewm_rrr_blur_text_color });
		$(".ewm_rrr_happy_not_happy").css({ "background": ewm_rrr_blur_color , "color" : ewm_rrr_blur_text_color });
				
	}

    function ewm_rrr_update_hh_active_dropdown(){

            // Update on server
            // on response -> add variable on url
            // reload
            var form_data = new FormData() ;
        
            form_data.append( 'action', 'ewm_rrr_update_hh_active_post_id' );
    
            form_data.append( 'ewm_rrr_hh_post_id', $('.ewm_rrr_post_drop_down').val() );
    
            jQuery.ajax({
    
                url: ajax_object.ajaxurl,
    
                type: 'post',
    
                contentType: false,
    
                processData: false,
    
                data: form_data,
    
                success: function ( response ) {
    
                    window.location.search += '&ewm_rrr_current_step=ewm_rrr_happy_not_happy';
    
                },
    
                error: function (response) {
    
                    console.log( response );
    
                }
    
            });
    
    }

    function ewm_rrr_update_ff_active_dropdown(){

        // Update on server
        // on response -> add variable on url
        // reload
        var form_data = new FormData() ;
    
        form_data.append( 'action', 'ewm_rrr_update_ff_active_post_id' );

        form_data.append( 'ewm_rrr_ff_post_id', $('.ewm_rrr_post_drop_down_ff').val() );

        jQuery.ajax({

            url: ajax_object.ajaxurl,

            type: 'post',

            contentType: false,

            processData: false,

            data: form_data,

            success: function ( response ) {

                window.location.search += '&ewm_rrr_current_step=ewm_rrr_form';

            },

            error: function (response) {

                console.log( response );

            }

        });

    }

	function ewm_rrr_listen_triggers(){

		$(".ewm_rrr_happy_not_happy").click(function(){

            ewm_rrr_activate_h_n_h_step();

            $(".ewm_rrr_ob_move_next_2").click(function(){

                $(".ewm_rrr_add_gmb_link").click();
                        
            });

            $('.ewm_rrr_post_drop_down').change(function() {

                ewm_rrr_update_hh_active_dropdown();
                // Update on server
                // on response -> add variable on url
                // reload

            });

	    });

		$(".ewm_rrr_add_gmb_link").click(function(){

			ewm_rrr_activate_google_links();
			$(".ewm_rrr_ob_move_prev_3").click(function(){
				$(".ewm_rrr_happy_not_happy").click();
			});
			$(".ewm_rrr_ob_move_next_3").click(function(){
				$(".ewm_rrr_form").click();
			});

		});

		$(".ewm_rrr_form").click(function(){

			ewm_rrr_activate_feedback_form();

			$(".ewm_rrr_ob_move_prev_4").click(function(){
				$(".ewm_rrr_add_gmb_link").click();
			});
			$(".ewm_rrr_ob_move_next_4").click(function(){
				$(".ewm_rrr_thank_you").click();
			});

            $('.ewm_rrr_post_drop_down_ff').change(function() {

                ewm_rrr_update_ff_active_dropdown();
                // Update on server
                // on response -> add variable on url
                // reload

            });

		});

		$(".ewm_rrr_thank_you").click(function(){

			ewm_rrr_activate_thank_you();
			$(".ewm_rrr_ob_move_prev_5").click(function(){
				$(".ewm_rrr_form").click();
			});

		});

	}

	ewm_rrr_listen_triggers();

    var url_string = window.location.href; 
    var url = new URL(url_string);
    var ewm_rrr_c = url.searchParams.get("ewm_rrr_current_step");

    ewm_rrr_click_on_a_tab = 'ewm_rrr_happy_not_happy';

    if( ewm_rrr_c == 'ewm_rrr_add_gmb_link' ){

        ewm_rrr_click_on_a_tab = 'ewm_rrr_add_gmb_link';

    }
    else if(  ewm_rrr_c == 'ewm_rrr_form' ){

        ewm_rrr_click_on_a_tab = 'ewm_rrr_form';

    }
    else if( ewm_rrr_c  =='ewm_rrr_happy_not_happy'){

        ewm_rrr_click_on_a_tab = 'ewm_rrr_happy_not_happy';
        
    }

    $("." + ewm_rrr_click_on_a_tab ).click();

    function ewm_rrr_remove_form_submission( args ){

        var form_data = new FormData() ;
    
        form_data.append( 'action', 'ewm_rrr_delete_single_review_e' );

        form_data.append( 'ewm_rrr_f_review_id', args );

        jQuery.ajax({

            url: ajax_object.ajaxurl,

            type: 'post',

            contentType: false,

            processData: false,

            data: form_data,

            success: function ( response ) {

                console.log( response );

                response = jQuery.parseJSON( response );

                $( '#ewm_rrr_submission_id_'+ response.ewm_rrr_f_review_id ).remove();

            },

            error: function (response) {

                console.log( response );

            }

        });
    }

    $('.ewm_rrr_single_line_d').click(function(){

        // console.log('ewm_rrr_single_line_d');

        // remove on server 
        ewm_rrr_remove_form_submission( $( this ).data( 'post-id' ) );
        // remove line on local

    })

    $('.ewm_rr_mobile_prev').click(function() {
        ewm_rr_step_mobile = $( this ).data('ewm_rr_step_mobile');
        $( '.'+ewm_rr_step_mobile ).click();
    });

    $('.ewm_rr_mobile_generator_menu').click(function() {

        $('.ewm_rr_mobile_generator_menu').css( {
            "border": "1px solid #ccc"
        } );
        
        $( this ).css( {
            "border": "2px solid #3335"
        } )

        $('.ewm_rr_mobile_list').hide();
        ewm_rr_step_mobile = $(this).data('ewm_rr_step_mobile');
        $( '.'+ewm_rr_step_mobile ).show();

    })   
	
    $('.ewm_rrr_post_drop_down').change(function() {

        alert('hello');
    });

} ) ;
