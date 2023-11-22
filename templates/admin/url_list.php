<style>
	.ewm_rrr_table_st{
		margin: 0px 20px 20px 10px;
		min-width: 97.5%;
		background: #fff;
		padding: 20px;
		border-radius: 10px;
	}	
	.ewm_rr_single_td_h{
		padding: 10px;
		background-color: #f9f9f9;
		color: #333;
		border-radius: 6px;
		min-width: 25%;
	}
	.ewm_rr_header_h{
		width: 100%;
	}
	.ewm_rr_tr_head{
		width: 100%;
	}
	.ewm_rr_td_b{
		padding: 6px 10px;
		background-color: #fff;
		color: #333;
	}
	.edit_location_link{
		padding: 8px 10px;
		background-color: yellowgreen;
		border: 0px;
		margin: 5px;
		border-radius: 10px;
		cursor: pointer;
		color: #fff;
		float: left;
		text-decoration: none;
	}
	.delete_location_link{
		background: #fff;
		border: 0px;
		border-radius: 10px;
		padding: 10px;
		cursor: pointer;
		float: left;
		margin: 5px;
		color: #ccc;
	}
	.review_link_detail_id{
		color: #333;
	}
	.ewm_wr_link_manager{
		width: 100%;
		overflow: auto;
	}
	#ewm_rrr_main_pop_content{
    	padding: 5px 30px;
	}
	.ewm_rr_guide_list{
		padding: 5px 30px;
		overflow: auto;
		background: aliceblue;
		width: 85%;
		border-radius: 15px;
		margin: 10px 30px;
	}
	.ewm_rr_title_details{
		padding: 0px 4px;
	}
	.ewm_rr_get_mobile{
		border: 1px solid seagreen;
		border-radius: 15px;
		padding: 5px 15px;
		margin: 5px;
		color: seagreen;
		cursor: pointer;
		float: left;
		background: #2e8b570f;
	}
	.ewm_rr_mobile_title{
		float: left;
		padding: 12px 0px 5px 0px;
	}

	.ewm_rr_get_mobile_question_mark{
		border: 1px solid seagreen;
		border-radius: 20px;
		padding: 0px 6px;
		margin-right: 10px;
		background: seagreen;
		color: #fff;
	}
	.ewm_rr_mobile_dp_img{
		width: 60%;
	}
	.ewm_rr_mobile_list_item{
		padding: 30px;
		overflow: auto;
		width: 90%;
	}
	.ewm_rr_menu_steps{
		width: 90%;
    	overflow: auto;
	}
	.ewm_rr_mobile_icon{
		list-style: disc;
	}

</style>

<div class="ewm_rrr_table_st_top">

	<hr class="wp-header-end">

	<?php $arr_count = count( $post_link_list ) ;	?>

	<h2 class="screen-reader-text">Filter posts list</h2>

	<div class="subsubsub subsubsub_rr add_link_but_top">
		<div class="publish add_link_but"><a href="#" class="" data-is-new-link="1" id="add_new_location_link" > New Location Link </a></div>
	</div>

	<div class="ewm_wr_link_manager">
		<center>
			<div class="leave_comment_s">
				<?php 
					echo  '<a href="' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/leave-us-a-review" target="_blank"><span class=""> Rotation Link: <b>' . $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/leave-us-a-review</b></span></a>' ;
				?>
				<span id="ewm_rrr_how_to_sh_link" >
					<span class="ewm_rrr_question_mark_circle" >?</span>
					How to shorten the link
				</span> 
			</div>
		</center>
	</div>

	<br class="clear">
	
	<div>
		<h2 class="screen-reader-text">Posts list</h2>
	</div>

	<div>
		<table class="ewm_rrr_table_st" >
			<thead class="ewm_rr_header_h">
				<tr class="ewm_rr_single_tr_h">
					<th scope="col" id="author" class="ewm_rr_single_td_h">
						Location
					</th>
					<th scope="col" id="author" class="ewm_rr_single_td_h">
						Review link( Desktop )
					</th>
					<th scope="col" id="author" class="ewm_rr_single_td_h">
						Review link( Mobile )
					</th>
					<th scope="col" id="date" class="ewm_rr_single_td_h">
					</th>	
				</tr>
			</thead>

			<tbody id="the-list">
			
				<?php 

				$index_id = 0 ;

				$session_array = [] ;

				foreach( $post_link_list as $key => $value ){

					$line_id_key   = $key;

					$session_array[ $line_id_key  ] = $value;

					$arr_d = maybe_unserialize( maybe_unserialize( $value ) );
					//$wp_is_mobile = wp_is_mobile();
					// var_dump( $wp_is_mobile );

					$location			 = $arr_d[ 'location_address' ] ;

					$review_link		 = $arr_d[ 'location_link' ] ;

					$review_link_mobile	 = $arr_d[ 'location_link_mobile' ] ;

					$number_of_locations = count( $post_link_list ) ;

					$manager_link        = $value ;

					include dirname(__FILE__).'/single_location.php';

					$index_id++ ;

				}

				?>

			</tbody>
		
		</table>
	</div>
</div>

<?php
	include dirname( __FILE__ ) . '/pop_up.php';
	include dirname( __FILE__ ) . '/../admin/pop_up_shorten.php';
?>