<div class="wt_dark_background_address">

	<div id="pop_address_fields">

		<div class="top_nav_fields">
			<span class="close_box_address"> Close [x] </span>
		</div>
		<div id="ewm_rrr_main_pop_content">
			<div class="ewm_rr_popup_fields">
				<div class="ewm_rr_title_details">
					Location Name
				</div>
				<div class="ewm_rr_input_details">
					<input name="wt_location_address" id="wt_location_address" type="text" placeholder="Location">
				</div>
			</div>
			<div class="ewm_rr_popup_fields">
				<div class="ewm_rr_title_details">
					Review Link( Desktop )
				</div>
				<div class="ewm_rr_input_details">
					<input name="wt_review_link" id="wt_review_link" type="text" value="" placeholder="Review Link( Desktop )">
				</div>
			</div>
			<div class="ewm_rr_popup_fields">
				<div class="ewm_rr_title_details">
					<span class="ewm_rr_mobile_title">Review Link( Mobile )</span> <span class="ewm_rr_get_mobile"> <span class="ewm_rr_get_mobile_question_mark">?</span>How to get mobile link</span>
				</div>
				<div class="ewm_rr_input_details">
					<input name="wt_review_link_mobile" id="wt_review_link_mobile" type="text" value="" placeholder="Review Link( Mobile )">
				</div>
			</div>

			<input name="wt_previous_value_link" id="wt_previous_value_link" type="hidden">
			<input name="wt_link_to_update_link" id="wt_link_to_update_link" type="hidden">
			<center>
				<input name="wt3_background" type="button" id="wt_company_location_submit" value="Update" >
			</center>

		</div>
	</div>
</div>
<div class="wt_dark_background_company">
	<div id="pop_company_fields">
		<div class="top_nav_fields">

		<span class="close_box_company"> close [x] </span>

		</div>
		<div>
		<input name="wt_company_name_text" id="wt_company_name_text" type="text" data-company-id="<?php echo $round_robin_company_id; ?>" value="<?php echo $company_name ; ?>" > <br>

		<input name="wt3_background" id="wt_company_name_submit" type="button" value="Create new Company" >

		</div>
	</div>

</div>

<?php ?>