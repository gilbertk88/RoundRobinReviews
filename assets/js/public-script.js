jQuery(document).ready(function($) {

    function ewm_rrr_submit_fields(){

        $('.field_ewm_rrr_single_error_1, .field_ewm_rrr_single_error_2, .field_ewm_rrr_single_error_3, .field_ewm_rrr_single_error_4 ').hide();

        var form_data = new FormData() ;
    
        form_data.append( 'action', 'ewm_rrr_submit_review_form' );

        form_data.append( 'ewm_rrr_f_name_company_name', $('#ewm_rrr_f_name_company_name').val() );

        form_data.append( 'ewm_rrr_f_phone_number', $('#ewm_rrr_f_phone_number').val() );

        form_data.append( 'ewm_rrr_f_email', $('#ewm_rrr_f_email').val() );

        form_data.append( 'ewm_rrr_f_invoice_number', $('#ewm_rrr_f_invoice_number').val() );

        jQuery.ajax({

            url: ajax_object.ajaxurl,

            type: 'post',

            contentType: false,

            processData: false,

            data: form_data,

            success: function ( response ) {

                console.log( response );

                response = jQuery.parseJSON( response );

                $('.ewm_rrr_top_ff_layer').html( '<div class="ewm_rrr_thankyou_page">\
                    <center><h4>Thank You! Your Review is being worked On.</h4></center>\
                </div>');

                $('.ewm_rrr_thankyou_page').css({'padding':'150px 10px'});

            },

            error: function (response) {

                console.log( response );

            }

        } ) ;

    }

    $('#ewm_rrr_f_submit').click(function() {

        empty_values = 0;

        if(  $('#ewm_rrr_f_name_company_name').val().length == 0 ){ 
            $('.field_ewm_rrr_single_error_1').show();
            empty_values++ 
        }
        else{
            $('.field_ewm_rrr_single_error_1').hide();
        }

        if(  $('#ewm_rrr_f_phone_number').val().length == 0 ){ 
            $('.field_ewm_rrr_single_error_2').show();
            empty_values++ 
        }
        else{
            $('.field_ewm_rrr_single_error_2').hide();
        }

        if(  $('#ewm_rrr_f_email').val().length == 0 ){ 
            $('.field_ewm_rrr_single_error_3').show();
            empty_values++ 
        }
        else{
            $('.field_ewm_rrr_single_error_3').hide();
        }

        if(  $('#ewm_rrr_f_invoice_number').val().length == 0 ){ 
            $('.field_ewm_rrr_single_error_4').show();
            empty_values++ 
        }
        else{
            $('.field_ewm_rrr_single_error_4').hide();
        }

        if( empty_values == 0 ){
            ewm_rrr_submit_fields();
        }
        
    })

});