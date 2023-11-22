<style>
	.ewm_rr_single_f_td{
		min-width: 20%;
		font-size: 14px;
		background-color: #fff;
		color: #333;
		border-bottom: 1px solid #a9a9a930;
		padding: 0px 8px;
	}

	.ewm_rr_single_f_tr{
		width: 100%;
	}

	.ewm_rr_single_f_tb{
		width: 100%;
	}

</style>

<div class="ewm_rrr_review_f_parent">
	<div id="ewm_rrr_cf_h"> <center> Customer Feedback </center> </div>
	<table class="ewm_rr_t_outer">
		<thead class="ewm_rr_header_h">
			<tr class="ewm_rr_single_tr_h">
				<th scope="col" class="ewm_rr_t_header_item"> Name </th>
				<th scope="col" class="ewm_rr_t_header_item"> Phone Number </th>
				<th scope="col" class="ewm_rr_t_header_item"> Email </th>
				<th scope="col" class="ewm_rr_t_header_item"> Invoice </th>
				<th scope="col" class="ewm_rr_t_header_item"></th>
			</tr>
		</thead>
		<tbody id="the-list">
			<?php foreach ( $form_review as $meta_key => $meta_value ) {

				$post_meta_d = get_post_meta( $meta_value->ID );

				echo  '
					<tr class="ewm_rr_single_f_tr" id="ewm_rrr_submission_id_' . $meta_value->ID . '">
						<td class="ewm_rr_single_f_td">' . $post_meta_d["ewm_rrr_f_name_company_name"][0] . '</td>
						<td class="ewm_rr_single_f_td">' . $post_meta_d["ewm_rrr_f_phone_number"][0] . '</td>
						<td class="ewm_rr_single_f_td">' . $post_meta_d["ewm_rrr_f_email"][0] . '</td>
						<td class="ewm_rr_single_f_td">' . $post_meta_d["ewm_rrr_f_invoice_number"][0] . '</td>
						<td class="ewm_rr_single_f_td"> <span class="ewm_rrr_single_line_d delete_location_link dashicons dashicons-trash" data-post-id="' . $meta_value->ID . '" ></span> </td>
					</tr>';
				}
			?>
		</tbody>
	</table>
</div>
