<style>

	.ewm_rr_filter_parent{
		min-height:400px;
	}
	.ewm_rr_filter_question_line{
		font-size:22px;
		padding:30px;
	}
	.ewm_rr_yes_filter_button, .ewm_rr_no_filter_button{
		padding:10px 30px;
		/*background-color:white;*/
		border:1px solid gray !important;
		border-radius:5px;
		margin:5px
		/*color: #333;*/
	}

</style>

<?php 
$ff_page_id = get_option('ewm_rrr_ff_page_id');
						
$post_arr = get_post( $ff_page_id , 'ARRAY_A' );

?>

<div class="ewm_rr_filter_parent">
	<div class="ewm_rr_filter_question_line"><center>Were You Happy with our Product/ Service?</center></div>
	<div>
		<center>
			<a href="<?php echo  $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['SERVER_NAME'] . '/run-rotation-link' ; ?>"><button class="ewm_rr_yes_filter_button">Yes</button></a>
			<a href="<?php echo $post_arr['guid']; ?>"><button class="ewm_rr_no_filter_button">No</button</a>
		</center>
	</div>
</div>