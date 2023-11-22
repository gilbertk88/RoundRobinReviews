<style>
	.ewm_main_menu{
		margin:15px;
		padding:15px;
		background-color:#fff;
	}
	.ewm_rr_top_menu{
		border:0px solid #333;
		overflow:auto;
		padding-top:50px;
	}
	.ewm_rrr_happy_not_happy,
	.ewm_rrr_add_gmb_link,
	.ewm_rrr_form,
	.ewm_rrr_thank_you{
		background-color: #fff;
		float: left;
		color: #333;
		width: 21%;
		border: 1px solid #ccc;
		margin-right: 1%;
		padding: 6px 0px 6px 20px;
		border-radius: 3px;
		cursor: pointer;
	}

	#ewm_rr_main_content_det{
		color:#333;
	}

	.ewm_rr_hidden_area{
		display: none ;
	}

	#ewm_rr_main_content_det{
		/* margin: 30px 30px 10px 0px;*/ 
		background-color: #fff;
		padding: 20px;
		border-radius: 10px;
	}

	#h_un_h_activation_button{
		border: 0px solid gray;
		border-radius: 10px;
		padding: 10px 40px;
		cursor: pointer;
		background: yellowgreen;
		color: #fff;
	}
	#rrr_ff_activation_button{
		border: 1px solid gray;
		border-radius: 30px;
		padding: 8px 40px;
		cursor: pointer;
	}

	.ewm_rrr_ob_move_next_2, .ewm_rrr_ob_move_prev_3, .ewm_rrr_ob_move_next_3, .ewm_rrr_ob_move_prev_4,.ewm_rrr_ob_move_next_4,.ewm_rrr_ob_move_prev_5 {
		border: 1px solid #8080804a;
		border-radius: 30px;
		padding: 10px 40px;
		background-color: #fff;
		margin-top: 10px;
		cursor: pointer;
	}

	a.ewm_rrr_edit_ff_page_b, a.ewm_rrr_edit_hh_page_b{
		border: 0px solid gray;
		border-radius: 20px;
		padding: 8px 30px;
		margin-left: 10px;
		text-decoration: none;
		cursor: pointer;
		background: yellowgreen;
		color: #fff;
	}

	.ewm_rrr_edit_hh_page_p_class, .ewm_rrr_edit_ff_page_p_class{
    	padding-bottom: 20px;
    	overflow: auto;
	}
	.ewm_rr_happy_title_top{
		font-weight: bolder;

	}

</style>

<div class="ewm_main_menu">

	<div class="ewm_rr_top_menu">
		<div class="ewm_rrr_happy_not_happy"> Happy/ Not Happy </div>
		<div class="ewm_rrr_add_gmb_link"> Google Location Links </div>
		<div class="ewm_rrr_form"> Feedback Form </div>
		<div class="ewm_rrr_thank_you"> Completion </div>
	</div>
	<div id="ewm_rr_main_content_det">
	</div>

	<div class="ewm_rr_hidden_area">
		<div id="ewm_rrr_happy_not_happy_body">
			<div class="ewm_rr_section_1">
				<center>
					<div class="ewm_rr_happy_title_top"> Manage the "Happy/ Not Happy" Page </div> <br>

					<span class="ewm_rrr_huh_sec">
					<?php
						
						$filter_page_id = get_option('ewm_rrr_filter_page_id');

						if( !is_string( $filter_page_id ) ){

							echo '
							<button type="submit" id="h_un_h_activation_button">
								Create Happy/ Unhappy Filter Page
							</button>';

						}
						else{

							$ewm_rrr_active_filter_id = get_option( 'ewm_rrr_filter_page_id' ) ;
							// echo $ewm_rrr_details_list;
							$post_arr = get_post( $filter_page_id , 'ARRAY_A' );

							echo '<div>';
							echo '<div class="ewm_rrr_edit_hh_page_p_class">Page Link: <a href="' . $post_arr['guid'] .'">' . $post_arr['post_title'] . '</a></div>';
							echo edit_post_link( 'Edit Page', '', '', $post_arr['ID'] , 'ewm_rrr_edit_hh_page_b' ) ;
							echo '<div>';

						}

						$ewm_rrr_active_hh_d = get_option( 'ewm_rrr_active_hh_filter_page');

						$checked_or_unchecked = $ewm_rrr_active_hh_d == 'true' ? 'checked' : '' ;

					?>
	
					</span>
					<br/><br/>

					<input type="checkbox" name="ewm_rrr_active_hh_filter_page" id="ewm_rrr_active_hh_filter_page" <?php echo $checked_or_unchecked; ?>> Activate Happy/ Unhappy Filter<br/><br/><br/>

					<button class="ewm_rrr_ob_move_next_2"> Next >> </button>
				</center>
			</div>
		</div>
		<div id="ewm_rrr_add_gmb_link_body">
			<div class="ewm_rr_section_2"> 
				<?php
									
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
		
						include dirname( __FILE__ ) . '/url_list.php';
					
						// include dirname( __FILE__ ) . '/pop_up.php';
					
					?>
					<script type="text/javascript">
						round_robin_company_id = <?php echo  $round_robin_company_id ; ?>
					</script>
					<br/><br/>
				</center>
				<center>
					<button class="ewm_rrr_ob_move_prev_3"> << Previous </button>
					<button class="ewm_rrr_ob_move_next_3"> Next >> </button>
				</center>
			</div> 
		</div>
		<div id="ewm_rrr_form_body">
			<div class="ewm_rr_section_3">
				<center>
					<div class="ewm_rr_happy_title_top">Feedback Form</div><br/>
					<span id="ewm_rrr_ff_parent">
						<?php
						
						$ff_page_id = get_option('ewm_rrr_ff_page_id');
						if( !is_string( $ff_page_id ) ){

							echo '
							<button type="submit" id="rrr_ff_activation_button">
								Create Feedback Form Page
							</button>';

						}
						else{

							$ewm_rrr_active_filter_id = $ff_page_id ;
							// echo $ewm_rrr_details_list;
							$post_arr = get_post( $ff_page_id , 'ARRAY_A' ) ;

							echo '<div>';
								echo '<div class="ewm_rrr_edit_ff_page_p_class">Page Link: <a href="' . $post_arr['guid'] .'">' . $post_arr['post_title'] . '</a></div>';
								echo edit_post_link( 'Edit Page', '', '', $post_arr['ID'] , 'ewm_rrr_edit_ff_page_b' ) ;
							echo '<div>';

						}

						$ewm_rrr_active_ff_d = get_option( 'ewm_rrr_active_ff_page' );

						$checked_or_unchecked = $ewm_rrr_active_ff_d == 'true' ? 'checked' : '';

						?>
					
					</span>
					<br/><br/>

					<input type="checkbox" name="ewm_rrr_active_ff_filter_page" id="ewm_rrr_active_ff_filter_page" <?php echo $checked_or_unchecked; ?>> Activate The Feedback Form <br/><br/><br/>
					<button class="ewm_rrr_ob_move_prev_4"> << Previous </button>
					<button class="ewm_rrr_ob_move_next_4"> Next >> </button>

				</center>
			</div> 
		</div>
		<div id="ewm_rrr_thank_you_body">
			<div class="ewm_rr_section_4">
				<center>
					<div class="ewm_rr_happy_title_top">All Set Up!</div><br>
					<a href="<?PHP echo $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] ; ?>/wp-admin/admin.php?page=round-robin-review">
						<button type="submit" id="h_un_h_activation_button">
							Go to Round Robin Home
						</button>
					</a>

					<br/><br/><br/>
					<button class="ewm_rrr_ob_move_prev_5"> << Previous </button>
				</center>
			</div>
		</div>
	</div>

</div>

<?php

/*
	echo '
	<script type="text/javascript">
		var ewm_rrr_current_step = "";
	</script>';

	if( array_key_exists( 'ewm_rrr_current_step', $_GET ) ){

		if( $_GET['ewm_rrr_current_step'] == 'ewm_rrr_add_gmb_link' ){

			echo '<script type="text/javascript">
				var ewm_rrr_current_step = 'ewm_rrr_add_gmb_link';
			</script>';
		}

	}
*/

?>