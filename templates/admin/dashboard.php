<style>
	.ewm_wr_url_list{
		margin: 30px 20px 20px 10px;
		min-width: 90%;
		background: #fff;
		padding: 20px;
		border-radius: 10px;
	}
</style>

<div class="wrap">

	<div class="ewm_wr_url_list">

		<div class="wp-heading-inline" style="font-weight:bolder;font-size:18px;">
			<center>Rotation Links</center>
		</div>

		<?php include dirname( __FILE__ ) . '/url_list.php' ; ?>

	</div>

	<script type="text/javascript">
		round_robin_company_id = <?php echo  $round_robin_company_id; ?>
	</script>
	 
	<div id="ajax-response"></div>

	<div class="clear"></div>

</div>
